<template>
    <div>
        <vue-snotify></vue-snotify>

        <div class="container">
            <div class="row">

                <div class="col-lg-12">


                    <div class="col-md-12" style="padding-top: 50px">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top"
                                 v-holder="'img=100px200?theme=thumb&bg=55595c&fg=eceeef&text=' + list.name"
                                 alt="Activity Header Image" src=""
                                 style="object-fit: cover; max-height: 200px; width: auto; height: auto;">

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
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                v-on:click="reqCopyList(list.id)">
                                            Copy To My Lists
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="my-3 p-3 bg-white rounded box-shadow">
                        <h6 class="border-bottom border-gray pb-2 mb-0">List Items</h6>

                        <div class="media text-muted pt-3" style="font-size: 2em" v-for="act in list.activities">
                            <img v-holder="'img=50x50?random=true&amp;bg=007bff&amp;fg=007bff&amp;size=1&text=.'"
                                 alt="32x32" class="mr-2 rounded" data-holder-rendered="true"
                                 style="width: 50px; height: 50px;" src="">

                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="text-gray-dark">{{act.name}}</strong>
                                    <button class="btn btn-sm btn-outline-primary" v-if="act.description === '<p></p>'"
                                            v-on:click="onClickView(act.id)">View</button>
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
            list: Object,
        },
        data() {
            return {
                doingReqCopy: false,
            }
        },
        methods: {
            onClickView(itemId){
                window.location.href = '/explore/item/' + itemId ;
            },
            reqCopyList(listId){
                if(this.doingReqCopy){
                    return;
                }
                gtag('event', 'req-list-copy');
                this.doingReqCopy = true;
                this.$snotify.async('Called with promise', 'Success async', async () => {
                    let promise = await new Promise((resolve, reject) => {
                        const COPY_LIST = '/api/list/{listId}/copy';
                        return axios.post(COPY_LIST.replace('{listId}', listId))
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
                            });
                    });
                    this.doingReqCopy = false;
                    return promise;
                });
            },
        }
    }
</script>
