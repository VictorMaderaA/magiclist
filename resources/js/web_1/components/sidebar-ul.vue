<template>
    <div>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a class="nav-link" href="/explore">
                    <i class="fas fa-archive"></i>
                    <p>Discover Lists</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   v-on:click.stop.prevent="onCreateNewList()">
                    <i class="fas fa-plus-circle"></i>
                    <p>Create New List</p>
                </a>
            </li>

        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <draggable
                v-model="lists"
                v-bind="dragOptions"
                :move="onMoveCallback"
                @start="drag = true"
                @end="drag = false">
                <transition-group type="transition" :name="!drag ? 'flip-list' : null">
                    <li v-for="(item) in lists" :key="item.id" class="nav-item">
                        <a class="nav-link" v-on:click.stop.prevent="onListSelected(item)">
                            <i class="nav-icon" v-bind:class="listIcon(item)"></i>
                            <p>{{item.name}}</p>
                        </a>
                    </li>
                </transition-group>
            </draggable>

        </ul>
    </div>
</template>

<script>
    import Manager from '../js/dataManager'
    import draggable from 'vuedraggable'

    export default {
        name: "sidebar-ul",
        components: {
            draggable,
            Manager,
        },
        data() {
            return {
                firstLoad: true,
                lists: [],

                drag: false,
                orderModified: false,
            }
        },
        beforeMount() {
            Manager.$on('lists-updated', (lists) => {
                this.lists = [];
                this.lists = lists;
            });
        },
        mounted() {
            this.loadLists();
        },
        methods: {
            showDefaultList(){
                if(this.lists.length > 0){
                    this.onListSelected(this.lists[0]);
                }else{
                    this.onListSelected(null);
                }
            },
            async loadLists(){
                this.lists = await Manager.getLists();
                if(this.firstLoad){
                    this.showDefaultList();
                    this.firstLoad = false;
                }
            },


            onListSelected(list){
                this.$emit('list-selected', list);
                this.hideNavBar();
            },
            onCreateNewList(){
                this.$emit('create-list');
                this.hideNavBar();
            },
            hideNavBar(){
                if ($(window).width() < 950) {
                    let element = document.getElementById("sidebar");
                    element.classList.remove("sidebar-open");
                    element.classList.add("sidebar-closed", "sidebar-collapse");
                }
            },


            onMoveCallback(evt, originalEvent){
                this.orderModified = true;
            },
            listIcon(list){
                if(list.private){
                    return 'far fa-circle';
                }else{
                    return 'fas fa-globe';
                }
            }

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
            lists: function () {
                if(this.orderModified){
                    let newOrder = []
                    this.lists.forEach((x) => {
                        newOrder.push(x.id);
                    });
                    Manager.reqUpdateListsOrder(newOrder);
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
