<template>
    <show-list ref="showList"
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
                },
                curr:{
                    listId: null
                }
            }
        },
        methods: {
            showList(list){
                this.curr.listId = list.id;
                if(this.showing.list){
                    this.$refs.showList.updateComponent(this.curr.listId);
                }
                this.showing.list = true;
            },
            showCreateNewList(){
                console.log('Create New List - Main Component');
            }
        }
    }
</script>

<style scoped>

</style>
