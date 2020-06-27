<template>
    <div class="content">

        <div class="modal fade" id="modal-deleteItem" style="display: none;" aria-hidden="true" v-if="modalItem">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Are you sure? - Delete <strong><i>{{ modalItem.name }}</i></strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please Confirm You Want To Delete This Item</p>
                        <p><strong>You will not be able to restore it later.</strong></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                                v-on:click="onClickDeleteItem(modalItem)">
                            <strong>
                                DELETE
                            </strong>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-deleteList" style="display: none;" aria-hidden="true" v-if="list">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Are you sure? - Delete <strong><i>{{ list.name }}</i></strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please Confirm You Want To Delete This List</p>
                        <p>
                            <strong>
                                You'll lose access to all items from this list.
                                <br>
                                You will not be able to restore it later.
                            </strong>
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                                v-on:click="onClickDeleteList(list)">
                            <strong>
                                DELETE
                            </strong>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline card-info" v-if="list">
                        <div class="card-header">
                            <h3 class="card-title align-middle">
                                {{list.name}}
                            </h3>

                            <div class="card-tools">
                                <a class="btn btn-sm" v-on:click="onClickNewItem">
                                    <i class="fas fa-plus text-green"></i>
                                </a>

                                <a class="btn btn-sm" data-toggle="modal" data-target="#modal-editList"
                                   v-on:click="onClickEditList">
                                    <i class="fas fa-edit text-blue"></i>
                                </a>

                                <a class="btn btn-sm" data-toggle="modal" data-target="#modal-deleteList">
                                    <i class="fas fa-trash text-red"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <p>{{list.description}}</p>
                                </div>
                            </div>

                            <div class="d-flex align-content-center flex-wrap justify-content-around mb-3">
                                <div class="p-2 align-self-center">
                                    <h5>
                                        List Options
                                    </h5>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" v-model="list.todo"
                                                   id="todo" name="customRadio" value="0" style="cursor: pointer;"
                                                   v-on:click.capture.prevent="onClickTodo">
                                            <label for="todo" class="custom-control-label" style="cursor: pointer;">
                                                Todo List
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-2 align-self-center" v-if="list.todo">
                                    <h5>
                                        Show options
                                    </h5>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" v-model="card.showOptions"
                                                   id="pending" name="customRadio" value="0" style="cursor: pointer;">
                                            <label for="pending" class="custom-control-label" style="cursor: pointer;">
                                                Pending <small>{{ list.activities_pending_count }}</small>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" v-model="card.showOptions"
                                                   id="all" name="customRadio" value="1" style="cursor: pointer;">
                                            <label for="all" class="custom-control-label" style="cursor: pointer;">
                                                All <small>{{ list.activities_count }}</small>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" v-model="card.showOptions"
                                                   id="completed" name="customRadio" value="2" style="cursor: pointer;">
                                            <label for="completed" class="custom-control-label" style="cursor: pointer;">
                                                Completed <small>{{ list.activities_completed_count }}</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-8" style="margin: 1em">
                                    <div class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                        <input class="form-control form-control-sm ml-3 w-75" type="search" placeholder="Search in List"
                                               aria-label="Search" v-model="search">
                                    </div>
                                </div>
                            </div>

                            <div v-if="list.activities_count < 1">
                                <div class="row justify-content-center">
                                    <img v-on:click="onClickNewItem" style="max-height: 30vh; cursor: pointer;"
                                         sizes="(max-width: 1400px) 40vw, 1400px"
                                         srcset="
                                        img/app/new-item/item-welcome-200.png 200w,
                                        img/app/new-item/item-welcome-470.png 470w,
                                        img/app/new-item/item-welcome-660.png 660w,
                                        img/app/new-item/item-welcome-890.png 890w,
                                        img/app/new-item/item-welcome-1000.png 1000w,
                                        img/app/new-item/item-welcome-1400.png 1400w"
                                         src="img/app/new-item/item-welcome-1400.png"
                                         alt="Item Create First Image">
                                </div>
                                <div class="row justify-content-around">
                                    <h4 style="font-size:2vw; font-family: sans-serif; font-weight: bold; cursor: pointer;"
                                        v-on:click="onClickNewItem">
                                        <u>Create your next activity</u>
                                    </h4>
                                </div>
                            </div>


                            <div class="row justify-content-center">
                                <div class="col-md-10">
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
                                                    <div class="icheck-primary d-inline ml-2" v-if="list.todo">
                                                        <button type="button" class="btn btn-sm"
                                                                data-placement="top" data-original-title="Tooltip on top"
                                                                v-on:click="onClickCheck(item)">
                                                            <i class="far fa-square" v-if="!item.completed_at"
                                                               style="font-size: 1.5em;"></i>
                                                            <i class="far fa-check-square" v-if="item.completed_at"
                                                               style="font-size: 1.5em;"></i>
                                                        </button>
                                                    </div>
                                                    <span class="text">{{item.name}}</span>
                                                    <!-- General tools such as edit or delete-->
                                                    <div class="tools">
                                                        <i class="fas fa-eye text-gray" v-on:click="onClickItem(item)"></i>
                                                        <i class="fas fa-edit text-blue" v-on:click="onClickEditItem(item)"></i>
                                                        <i class="fas fa-trash text-red" v-on:click="onClickModalDeleteItem(item)"
                                                           data-toggle="modal" data-target="#modal-deleteItem"></i>
                                                    </div>
                                                </li>
                                            </transition-group>
                                        </draggable>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
        </div>
    <!-- ./row -->

    </div>

</template>

<script>
    import draggable from 'vuedraggable'
    import Manager from '../js/dataManager'

    export default {
        name: "show-list",
        components: {
            draggable,
            Manager,
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
                modalItem: null,
                list: {
                    activities_pending_count: 0,
                    activities_count: 0,
                    activities_completed_count: 0,
                    todo: null,
                },
                listItems: [],

                search: '',
                drag: false,
                orderModified: false,
                reqStateCurrent: [],
            }
        },
        mounted() {
          if(this.listId){
              this.curr.listId = this.listId;
              this.loadListData()
          }
          Manager.$on('list-updated', (list) => {
              this.list = list;
          })
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
        methods: {
            updateComponent(listId) {
                this.curr.listId = listId;
                this.loadListData();
            },
            async loadListData(){
                console.log('TEST')
                let list = await Manager.getListData(this.curr.listId, true);
                if(list){
                    this.list = list;
                    this.listItems = list.activities;
                }
            },


            async onClickCheck(item){
                if(this.reqStateCurrent.findIndex(x => x === item.id) !== -1){
                    return;
                }
                this.reqStateCurrent.push(item.id);
                let response = await Manager.reqUpdateActivityState(item.id, !item.completed_at);
                if(response.status === 200){
                    let newItems = this.listItems.slice(0);
                    let found = newItems.findIndex(e => e.id === item.id);
                    this.updateCounters(newItems[found].completed_at, response.data.completed_at);
                    newItems[found] = response.data;
                    this.listItems = newItems;
                }
                this.reqStateCurrent.splice(this.reqStateCurrent.findIndex(x => x === item.id), 1);
            },

            async onClickTodo(){
                if(this.reqStateCurrent.findIndex(x => x === 'todo') !== -1){
                    return;
                }
                this.reqStateCurrent.push('todo');
                let response = await Manager.updateList(this.list.id, null, null, !this.list.todo);
                if(!response){
                    //TODO show warning
                    console.error('Failed to change list todo');
                }
                this.reqStateCurrent.splice(this.reqStateCurrent.findIndex(x => x === 'todo'), 1);
            },

            updateCounters(oldState, newState){
                if(oldState && !newState){
                    //Estaba Activado
                    //Y ahora no esta Activado
                    this.list.activities_completed_count -= 1;
                    this.list.activities_pending_count += 1;

                }else if(newState){
                    //NO estaba Activado
                    //Y ahora esta Activado
                    this.list.activities_completed_count += 1;
                    this.list.activities_pending_count -= 1;
                }
            },


            async onClickDeleteList(list){
                await Manager.deleteList(list.id);
            },

            async onClickEditList(){
                this.$emit('edit-list', this.list);
            },

            onClickModalDeleteItem(item){
                this.modalItem = item;
            },
            async onClickDeleteItem(item){
                Manager.markListDataReload(item.list_id);
                let response = await Manager.deleteActivity(item.id);
                if(response){
                    this.loadListData()
                }else{
                    console.error('Failed to Delete element');
                }
            },
            onClickEditItem(item){
                this.$emit('edit-item', item);
            },
            onClickNewItem(){
                this.$emit('create-item', this.list);
            },
            onClickItem(item){
                this.$emit('selected-item', item);

            },

            canShowItem(item){
                if(this.search.length > 0 && !item.name.toLowerCase().includes(this.search.toLowerCase())){
                    return false;
                }
                if(!this.list.todo){
                    return true;
                }
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
        watch: {
            listItems: function () {
                if(this.orderModified){
                    let newOrder = []
                    this.listItems.forEach((x) => {
                        newOrder.push(x.id);
                    });
                    Manager.updateListActivitiesOrder(this.curr.listId, newOrder);
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
