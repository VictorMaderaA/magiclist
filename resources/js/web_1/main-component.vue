<template>
    <div>

        <div class="container" style="padding-top: 20vh;"
             v-if="showing.empty">
            <div class="container">
                <div class="row justify-content-around">
                    <img v-on:click="showCreateNewList" style="max-height: 40vh; cursor: pointer;"
                        sizes="(max-width: 1400px) 50vw, 1400px"
                        srcset="
                        img/app/new-list/list-welcome-200.png 200w,
                        img/app/new-list/list-welcome-762.png 762w,
                        img/app/new-list/list-welcome-1400.png 1400w"
                        src="img/app/new-list/list-welcome-1400.png"
                        alt="List Create First Image">
                </div>
                <div class="row justify-content-around"
                     v-on:click="showCreateNewList">
                    <h4 style="font-size:2vw; font-family: sans-serif; font-weight: bold; cursor: pointer;">
                        <u>Select or Create now a new List</u>
                    </h4>
                </div>
            </div>
        </div>

        <create-item ref="createItem"
                     :listid="curr.listId"
                     @list-show="showList"
                     @item-edit="showEditItem"
                     @cancel="showList"
                     v-if="showing.createItem"
        ></create-item>

        <create-list ref="createList"
                     @cancel="showList"
                     v-if="showing.createList"
        ></create-list>

        <edit-item ref="editItem"
                   :item="this.curr.itemId"
                   @saved-item="showItem"
                   @cancel="showList"
                   v-if="showing.editItem"
        ></edit-item>

        <edit-list ref="editList"
                   @cancel="showList"
                   :listId="this.curr.listId"
                   v-if="showing.editList">
        </edit-list>

        <show-item ref="showItem"
                   :item="this.curr.itemId"
                   @edit-item="showEditItem"
                   @return="showList"
                   @deleted="showList"
                   v-if="showing.item"
        ></show-item>

        <show-list ref="showList"
                   @edit-item="showEditItem"
                   @create-item="showCreateItem"
                   @selected-item="showItem"
                   @edit-list="showEditList"
                   :listId="curr.listId"
                   v-if="showing.list"
        ></show-list>

    </div>


</template>

<script>
    import Manager from './js/dataManager'

    export default {
        name: "main-component",
        components: {
            Manager
        },
        data(){
            return {
                showing: {
                    empty: false,
                    list: false,
                    item: false,
                    createList: false,
                    editItem: false,
                    editList: false,
                    createItem: false
                },
                curr:{
                    listId: null,
                    itemId: null,
                }
            }
        },
        mounted() {
            Manager.$on('list-created', (list) => {
                this.showList(list.id);
            });
            Manager.$on('list-deleted', () => {
                this.showEmpty();
            });
        },
        methods: {
            hideShowing(){
                for (let [k, v] of Object.entries(this.showing)) {
                    this.showing[k] = false;
                }
            },
            show(showKey){
                this.hideShowing();
                this.showing[showKey] = true;
            },

            showEmpty(){
                this.show('empty')
            },
            showList(list){
                if(!this.setCurrList(list)){
                    this.showEmpty();
                    return;
                }

                if(this.showing.list){
                    this.$refs.showList.updateComponent(this.curr.listId);
                }
                this.hideShowing();
                this.showing.list = true;
            },
            showItem(item){
                this.setCurrItem(item)
                this.show('item')
            },

            showCreateNewList(){
                this.hideShowing();
                this.showing.createList = true;
            },
            showEditItem(item){
                this.setCurrItem(item)
                this.show('editItem')
            },
            showEditList(list){
                if(!this.setCurrList(list)){
                    return;
                }
                this.show('editList');
            },
            showCreateItem(item){
                this.hideShowing();
                this.showing.createItem = true;
            },


            setCurrList(list){
                if(!list) {
                    if(!this.curr.listId){
                        return false;
                    }
                    return true;
                }
                if(Number.isInteger(list)){
                    this.curr.listId = list;
                }else{
                    this.curr.listId = list.id;
                }
                return true;
            },
            setCurrItem(item){
                if(!item) {
                    if(!this.curr.itemId){
                        return false;
                    }
                    return true;
                }
                if(Number.isInteger(item)){
                    this.curr.itemId = item;
                }else{
                    this.curr.itemId = item.id;
                }
                return true;
            }

        }
    }
</script>
