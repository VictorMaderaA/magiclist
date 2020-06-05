<template>
    <div class="row justify-content-center">

        <div id="overlay" v-if="showCreate">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card m-md-6" style="top: 35%">
                        <div class="card-header">Crate New List<button @click="hideCreateOverlay">Close</button></div>
                        <div class="card-body">
                            <list-create @created-list="onListCreated"></list-create>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-12">
                        <h3 class="card-header">
                            Stored Lists
                            <button @click="showCreateOverlay">Create</button>
                        </h3>
                        <ul class="list-group list-group-flush" v-if="itemsList">
                            <draggable
                                v-model="itemsList"
                                v-bind="dragOptions"
                                :move="onMoveCallback"
                                :handle="'.handle'"
                                @start="drag = true"
                                @end="drag = false">
                                <transition-group type="transition" :name="!drag ? 'flip-list' : null">

                                    <div v-for="(item) in itemsList" :key="item.id">


                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-1 handle">
                                                    <i class="icofont-hand-drag"></i>
                                                </div>

                                                <div class="col-sm">
                                                    <h4>
                                                        {{item.name}}
                                                    </h4>
                                                </div>
                                                <div class="col-sm">
                                                    <small>
                                                        Contains {{item.activities_count}} items
                                                        <br>
                                                        Pending: {{ item.activities_pending_count}}
                                                        <br>
                                                        Completed: {{ item.activities_completed_count}}
                                                    </small>
                                                </div>
                                                <div class="col-sm">

                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-sm btn-outline-info"
                                                                data-placement="left" title="" data-original-title="Tooltip on left"
                                                                @click="onClickEdit(item)">
                                                            <i class="icofont-edit"></i>
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
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>

    function on() {
        document.getElementById("overlay").style.display = "block";
    }

    function off() {
        document.getElementById("overlay").style.display = "none";
    }

    import draggable from 'vuedraggable'

    export default {
        name: "lists-index",
        components: {
            draggable
        },
        props: {
            importedList: Array,
        },
        data (){
            return {
                itemsList: [],
                drag: false,
                orderModified: false,
                showCreate: false
            }
        },
        beforeMount(){
            this.itemsList = this.$attrs.importedlist;
            this.loadItemsList();
        },
        mounted(){

        },
        methods: {
            loadItemsList(){
                if(!this.itemsList){
                    return;
                }
                let newItemsList = [];
                this.itemsList.forEach((item) => {
                    newItemsList.push(item);
                });
                this.itemsList = newItemsList;
            },
            onMoveCallback(evt, originalEvent){
                this.orderModified = true;
            },
            onClickEdit(item){
                window.location.href = '/list/'+item.id;
            },
            onListCreated(list){
                this.itemsList.push(list);
                this.hideCreateOverlay();
            },

            showCreateOverlay() {
                this.showCreate = true;
            },
            hideCreateOverlay() {
                this.showCreate = false;
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
        },
    }
</script>

<style scoped>


    #overlay {
        position: fixed; /* Sit on top of the page content */
        display: block; /* Hidden by default */
        width: 100%; /* Full width (cover the whole page) */
        height: 100%; /* Full height (cover the whole page) */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5); /* Black background with opacity */
        z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
        cursor: pointer; /* Add a pointer on hover */
    }

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
