<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-info" v-if="list">
                <div class="card-header">
                    <h3 class="card-title align-middle">
                        {{list.name}}
                    </h3>

                    <div class="card-tools">
                        <a class="btn btn-sm">
                            <i class="fas fa-edit text-blue"></i>
                        </a>

                        <a class="btn btn-sm">
                            <i class="fas fa-trash text-red"></i>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="row" style="margin: 10px;">
                    <div class="col-3">
                        <h5>
                            Show options
                        </h5>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" v-model="card.showOptions"
                                       id="pending" name="customRadio" value="0">
                                <label for="pending" class="custom-control-label">
                                    Pending <small>{{ list.activities_pending_count }}</small>
                                </label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" v-model="card.showOptions"
                                       id="all" name="customRadio" value="1">
                                <label for="all" class="custom-control-label">
                                    All <small>{{ list.activities_count }}</small>
                                </label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" v-model="card.showOptions"
                                       id="completed" name="customRadio" value="2">
                                <label for="completed" class="custom-control-label">
                                    Completed <small>{{ list.activities_completed_count }}</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">

                    </div>
                </div>

                <div class="card-body">

                    <ul class="todo-list ui-sortable" data-widget="todo-list">
                        <draggable
                            v-model="listItems"
                            v-bind="dragOptions"
                            :handle="'.handle'"
                            :move="onMoveCallback"
                            @start="drag = true"
                            @end="drag = false">


                            <transition-group type="transition" :name="!drag ? 'flip-list' : null"
                                              class="todo-list ui-sortable">
                                    <li v-for="(item) in listItems" :key="item.id" v-if="canShowItem(item)"
                                        v-bind:class="{ done: item.completed_at}">
                                        <!-- drag handle -->
                                        <span class="handle ui-sortable-handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                        <!-- checkbox -->
                                        <div class="icheck-primary d-inline ml-2">
                                            <button type="button" class="btn btn-sm"
                                                    data-placement="top" data-original-title="Tooltip on top"
                                                    v-on:click="onClickCheck(item)">
                                                <i class="far fa-square" v-if="!item.completed_at"></i>
                                                <i class="far fa-check-square" v-if="item.completed_at"></i>
                                            </button>
                                        </div>
                                        <span class="text">{{item.name}}</span>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </li>
                            </transition-group>
                        </draggable>
                    </ul>


                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- ./row -->
</template>

<script>
    import draggable from 'vuedraggable'


    export default {
        name: "show-list",
        components: {
            draggable,
        },
        props: {
            listId: Number
        },
        data() {
            return {
                curr: {
                    listId: null,
                },
                card:{
                    showOptions: "0"
                },
                list: {},
                listItems: [],


                drag: false,
                orderModified: false,
            }
        },
        mounted() {
          if(this.listId){
              this.curr.listId = this.listId;
              this.loadListData()
          }
        },
        methods: {
            updateComponent(listId) {
                this.curr.listId = listId;
                this.loadListData();
            },
            async loadListData(){
                let response = await this.reqListData(this.curr.listId);
                if(response.status === 200){
                    this.list = response.data;
                    this.listItems = response.data.activities;
                }
            },


            async onClickCheck(item){
                let response = await this.reqChangeActivityState(item.id, !item.completed_at);
                if(response.status === 200){
                    let newItems = this.listItems.slice(0);
                    let found = newItems.findIndex(e => e.id === item.id);
                    newItems[found] = response.data;
                    this.listItems = newItems;
                }
            },


            onClickDeleteList(){
                console.log('onClickDeleteList');
            },
            onClickEditList(){
                console.log('onClickEditList');
            },

            onClickDeleteItem(){
                console.log('onClickDeleteItem');
            },
            onClickEditItem(){
                console.log('onClickEditItem');
            },
            onClickNewItem(){
                console.log('onClickNewItem');
            },


            reqListData: async function (listId) {
                const URL = '/api/list/' + listId;
                return axios.get(URL, {})
                    .then(function (resp) {
                        // console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        // console.error(err.response);
                        return err;
                    });
            },
            reqModifyActivitiesOrder: async function (listId, newOrder) {
                const URL = '/api/list/' + listId + '/change-activities-order';
                return axios.post(URL, {
                    data: newOrder
                })
                    .then(function (resp) {
                        // console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        // console.error(err.response);
                        return err;
                    });
            },
            reqChangeActivityState: async function (activityId, bool) {
                const URL = '/api/activity/' + activityId + '/change-completed-state';
                if(bool){
                    bool = 1;
                }else{
                    bool = 0;
                }
                return axios.post(URL, {
                    state: bool
                })
                    .then(function (resp) {
                        // console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        // console.error(err.response);
                        return err;
                    });
            },


            canShowItem(item){
                if(this.card.showOptions === "1"){
                    return true;
                }
                if(this.card.showOptions === "0" && !item.completed_at){
                    return true;
                }
                if(this.card.showOptions === "2" && item.completed_at){
                    return true;
                }
                return false;
            },


            onMoveCallback(evt, originalEvent){
                this.orderModified = true;
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
            },
        },
        watch: {
            listItems: function () {
                if(this.orderModified){
                    let newOrder = []
                    this.listItems.forEach((x) => {
                        newOrder.push(x.id);
                    });
                    this.reqModifyActivitiesOrder(this.curr.listId, newOrder);
                    this.orderModified = false;
                }
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
