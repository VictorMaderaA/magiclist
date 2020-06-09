<template>
    <div>

        <create-item ref="createItem"
                     :listid="curr.listId"
                     @list-show="showList"
                     @item-edit="showEditItem"
                     @cancel="showList"
                     v-if="showing.createItem"
        ></create-item>

        <create-list ref="createList"
                     @created-list="onListCreated"
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
                   @list-deleted="onListDeleted"
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

    // export const S_LIST = 'list';
    // export const S_ITEM = 'item';
    // export const S_LIST_CREATE = 'createList';
    // export const S_LIST_EDIT = 'editList';
    // export const S_ITEM_EDIT = 'editItem';
    // export const S_ITEM_CREATE = 'createItem';

    export default {
        name: "main-component",
        data(){
            return {
                showing: {
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

            showList(list){
                if(!this.setCurrList(list)){
                    console.error('Missing List - Aborting')
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
                console.log('Create New List - Main Component');
                this.showing.createList = true;
            },
            showEditItem(item){
                this.setCurrItem(item)
                this.show('editItem')
            },
            showEditList(list){
                if(!this.setCurrList(list)){
                    console.error('Missing List - Aborting')
                    return;
                }
                this.show('editList');
            },
            showCreateItem(item){
                this.hideShowing();
                console.log('Create Item - Main Component');
                this.showing.createItem = true;
            },



            onListCreated(list){
                this.$emit('list-created')
                this.showList(list);
            },
            onListDeleted(){
                this.$emit('list-created')
                this.hideShowing();
                //TODO CHANGE EMIT METHOD
            },


            setCurrList(list){
                if(!list) {
                    if(!this.curr.listId){
                        console.error('No Current List Selected')
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
                        console.error('No Current Item Selected')
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

<style scoped>

</style>
