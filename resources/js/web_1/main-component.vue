<template>
    <show-list ref="showList"
               @edit-list="showEditList"
               @edit-item="showEditItem"
               @create-item="showCreateItem"
               @selected-item="showItem"
               :listId="curr.listId"
               v-if="showing.list"
    ></show-list>

</template>

<script>
    import ShowList from "./components/show-list";
    export default {
        name: "main-component",
        components: {
            'showList': ShowList
        },
        data(){
            return {
                showing: {
                    list: false,
                    item: false,
                    createList: false,
                    editList: false,
                    editItem: false,
                    createItem: false
                },
                curr:{
                    listId: null
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
                this.hideShowing();
                this.curr.listId = list.id;
                if(this.showing.list){
                    this.$refs.showList.updateComponent(this.curr.listId);
                }
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
            showEditList(list){
                this.hideShowing();
                console.log('Edit List - Main Component');
                this.showing.editList = true;
            },
            showEditItem(item){
                this.hideShowing();
                console.log('Edit Item - Main Component');
                this.showing.editItem = true;
            },
            showCreateItem(item){
                this.hideShowing();
                console.log('Create Item - Main Component');
                this.showing.createItem = true;
            },

        }
    }
</script>

<style scoped>

</style>
