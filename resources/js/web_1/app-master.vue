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
            on
        }
    }
</script>

<style scoped>



</style>
