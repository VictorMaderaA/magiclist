<script>
    export default {
        name: "app-master",
        methods: {
            onListSelected(list){
                this.$refs.mainComponent.showList(list);
            }
        }
    }
</script>

<style scoped>



</style>
