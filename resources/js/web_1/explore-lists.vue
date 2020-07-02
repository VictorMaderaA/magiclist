<template>
    <div>
        <vue-snotify></vue-snotify>

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Explore Public Lists</h1>
                <p class="lead text-muted">Here you can find a variety of lists explore them and copy them in to your own</p>
                <p>
                    <a href="/app" class="btn btn-primary my-2">Create Your Own List</a>
<!--                    <a href="/" class="btn btn-secondary my-2">Secondary action</a>-->
                </p>
            </div>
        </section>


        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">


                    <div class="col-md-6" v-for="list in lists">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top"
                                 v-holder="'img=100px150?random=yes&bg=55595c&fg=eceeef&text=' + list.name"
                                 alt="Card image cap" src=""
                                 style="object-fit: cover; max-height: 150px; width: auto; height: auto;">

                            <div class="card-header">
                                <p class="card-title text-center" >
                                    <strong style="font-size: 1.5em">
                                        {{ list.name }}
                                    </strong>
                                </p>
                            </div>

                            <div class="card-body">
                                <p class="card-text text-center ">{{ list.description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                                v-on:click="onClickView(list.id)">
                                            View
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                                v-on:click="reqCopyList(list.id)">
                                            Copy To My Lists
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        name: "explore-lists.vue",
        props: {
            lists: Array,
        },
        data() {
            return {
                doingReqCopy: false,
            }
        },
        methods: {
            onClickView(listId){
                window.location.href = '/explore/list/' + listId ;
            },
            reqCopyList(listId){
                if(this.doingReqCopy){
                    return;
                }
                gtag('event', 'req-list-copy');
                this.doingReqCopy = true;
                this.$snotify.async('Called with promise', 'Success async', async () => {
                    return new Promise(async (resolve, reject) => {
                        const COPY_LIST = '/api/list/{listId}/copy';
                        let promise = await axios.post(COPY_LIST.replace('{listId}', listId))
                            .then(function (response) {
                                resolve({
                                    title: 'List Copied!!!',
                                    body: 'You can find it in your lists!',
                                    config: {
                                        closeOnClick: true,
                                        showProgressBar: true,
                                        timeout: 5000,
                                    }
                                });
                                return response;
                            })
                            .catch(function (error) {
                                reject({
                                    title: 'Failed To Copy!!!',
                                    body: 'Something went Wrong! :(',
                                    config: {
                                        closeOnClick: true,
                                        showProgressBar: true,
                                        timeout: 3000,
                                    }
                                });
                                return error;
                            });
                        this.doingReqCopy = false;
                        if(promise.response.status === 401){
                            this.$snotify.warning('A new Tab will open', 'Need to login', {
                                closeOnClick: true,
                                showProgressBar: true,
                                timeout: 2000,
                            });
                            setTimeout(() => window.open('/login', '_blank'), 2000);
                        }
                        return promise;
                    });

                });
            },
        }
    }
</script>
