<script>
    export default {
        name: "app-master",
        methods: {
            onListSelected(list){
                this.$refs.mainComponent.showList(list);
            },
            onShowCreateNewList(){
                console.log('Create New List Master');
                this.$refs.mainComponent.showCreateNewList();
            },
            // onShowEditList(list){
            //     console.log('Edit List Master', list);
            // },
            // onShowEditItem(item){
            //     console.log('Edit Item Master', item);
            // },
            // onShowCreateItem(list){
            //     console.log('Create Item Master', list);
            // },

            onListCreated(list){
                this.$refs.sidebarUl.loadLists();
                //TODO Add existing list from param
            }

        }
    }
</script>

<style scoped>



</style>
