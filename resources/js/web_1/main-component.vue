<template>
    <div>

        <create-item ref="createItem"
                     @edit-item="showEditItem"
                     @created-item="showItem"
                     @cancel="showList"
                     v-if="showing.createItem"
        ></create-item>

        <create-list ref="createList"
                     @created-list="onListCreated"
                     @cancel="showList"
                     v-if="showing.createList"
        ></create-list>

        <edit-item ref="editItem"
                   :item="this.curr.listId"
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
                    this.curr.listId = list.id;
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

        }
    }
</script>

<style scoped>

</style>
