<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mb-3">
                    <h3 class="card-header">{{listName}}</h3>
<!--                    <div class="card-body">-->
<!--                        <h5 class="card-title">Special title treatment</h5>-->
<!--                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>-->
<!--                    </div>-->

<!--                    <img style="height: 200px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158bd1d28ef%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158bd1d28ef%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22129.359375%22%20y%3D%2297.35%22%3EImage%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image">-->
                    <div class="card-body">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                   v-model="showCompleted" @change="onModifiedShowCompleted">
                            <label class="custom-control-label" for="customSwitch1">Mostrar Completadas</label>
                        </div>
                        <p class="card-text">Contenido:</p>
                    </div>

                    <ul class="list-group list-group-flush" v-if="itemsList">
                        <draggable
                            v-model="itemsList"
                            v-bind="dragOptions"
                            @start="drag = true"
                            @end="drag = false">
                            <transition-group type="transition" :name="!drag ? 'flip-list' : null">

                                <div v-for="(item) in itemsList" :key="item.id">
                                    <div class="container" v-if="item.canShow">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="icofont-hand-drag"></i>
                                            </div>

                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-placement="top" title="" data-original-title="Tooltip on top"
                                                        v-on:click="onClickCheck(item)">
                                                    <i class="icofont-ui-check" v-if="item.completed_at"></i>
                                                    <i class="icofont-square" v-if="!item.completed_at"></i>
                                                </button>
                                            </div>

                                            <div class="col-sm">
                                                {{item.name}}
                                            </div>
                                            <div class="col-sm">
                                                <small>
                                                    {{reduceDescription(item.description, 50)}}
                                                </small>
                                            </div>
                                            <div class="col-sm">

                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-sm btn-outline-info"
                                                            data-placement="left" title="" data-original-title="Tooltip on left">
                                                        <i class="icofont-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-info"
                                                            data-placement="top" title="" data-original-title="Tooltip on top">
                                                        <i class="icofont-checked"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-placement="top" title="" data-original-title="Tooltip on top">
                                                        <i class="icofont-trash"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </transition-group>
                        </draggable>

                    </ul>

                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>



    </div>

</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        name: "list-main-card",
        components: {
            draggable,
        },
        props: {
            listimport: Object
        },
        data() {
            return {
                listName: null,
                itemsList: null,
                showCompleted: true,
                drag: false,
            }
        },
        mounted() {
            console.log('Mounted')
            this.listName = this.listimport.name;
            this.itemsList = this.listimport.activities;
            this.loadItemsList();
        },
        methods: {

            loadItemsList(){
                let newItemsList = [];
                this.itemsList.forEach((item) => {
                    let show = true;

                    if(!this.showCompleted && item.completed_at){
                        show = false;
                    }

                    item.canShow = show;
                    newItemsList.push(item);
                });
                this.itemsList = newItemsList;
            },

            onModifiedShowCompleted(){
                this.loadItemsList();
            },

            async onClickCheck(item){
                let response = await this.reqChangeActivityState(item.id, !item.completed_at);
                if(response.status === 200){
                    let found = this.itemsList.find(e => e.id === item.id);
                    found.completed_at = !found.completed_at;
                    this.loadItemsList();
                }
            },



            reqChangeActivityState: async function (activityId, bool) {
                console.log(activityId, bool)
                const URL = '/api/activity/' + activityId + '/change-completed-state';
                if(bool){
                    bool = 1;
                }else{
                    bool = 0;
                }
                return await axios.post(URL, {
                    state: bool
                })
                    .then(function (resp) {
                        console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        console.error(err.response);
                        return err;
                    });
            },


            reduceDescription(desc, maxLenght)
            {
                if(desc.length > maxLenght){
                    return desc.substr(0,maxLenght) + '...';
                }else{
                    return desc;
                }
            },
        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        }

    }
</script>

<style scoped>
    .flip-list-move {
        transition: transform 0.5s;
    }
    .no-move {
        transition: transform 0s;
    }
    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }
    .list-group {
        min-height: 20px;
    }

    .list-group-item {
        cursor: move;
    }
    .list-group-item i {
        cursor: pointer;
    }
</style>
