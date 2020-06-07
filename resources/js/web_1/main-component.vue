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

        <show-item ref="showItem"
                   @edit-item="showEditItem"
                   @return="showList"
                   v-if="showing.item"
        ></show-item>

        <show-list ref="showList"
                   @list-deleted="onListDeleted"
                   @edit-item="showEditItem"
                   @create-item="showCreateItem"
                   @selected-item="showItem"
                   :listId="curr.listId"
                   v-if="showing.list"
        ></show-list>

    </div>


</template>

<script>
    export default {
        name: "main-component",
        data(){
            return {
                showing: {
                    list: false,
                    item: false,
                    createList: false,
                    editItem: false,
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

            showList(list){
                if(list){
                    if(Number.isInteger(list)){
                        this.curr.listId = list;
                    }else{
                        this.curr.listId = list.id;
                    }
                }

                if(this.showing.list){
                    this.$refs.showList.updateComponent(this.curr.listId);
                }
                this.hideShowing();
                this.showing.list = true;
            },
            showItem(item){
                this.hideShowing();
                console.log('Show Item - Main Component');
                this.showing.item = true;
            },

            showCreateNewList(){
                this.hideShowing();
                console.log('Create New List - Main Component');
                this.showing.createList = true;
            },
            showEditItem(item){
                this.hideShowing();
                this.curr.itemId = item.id;
                this.showing.editItem = true;
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

        }
    }
</script>

<style scoped>

</style>
