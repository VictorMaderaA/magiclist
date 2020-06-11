<script>

    const refresher = {
        name: 'AuthRefresher',
        data () {
            return {
                timer: '',
                t: '',
            }
        },
        methods: {
            start(){
                this.timer = setInterval(function () {
                    this.refreshToken();
                }.bind(this), 600000);
                this.t = setInterval(function () {
                    this.refreshToken();
                }.bind(this), 5000);
            },
            destroy(){
                clearInterval(this.timer);
            },
            async refreshToken(){
                let response = await this.reqRefreshAuth();
                if(response.status !== 200){
                    if(response.response.status === 401){
                        console.error("Unauthorized - Needs to Log in");
                        window.location.href = "/login"
                        //TODO - SHOW ALERT BEFORE REDIRECT
                    }
                }
                clearInterval(this.t);
            },
            reqRefreshAuth: async function () {
                const URL = '/api/auth/refresh';
                return axios.post(URL, {
                    cookie: true,
                }, {
                })
                    .then(function (resp) {
                        // console.log(resp);
                        return resp;
                    })
                    .catch(function (err) {
                        // console.error(err.response);
                        return err;
                    });
            },
        }
    };

    export default {
        name: "app-master",
        components: {
            refresher
        },
        beforeCreate() {
            refresher.methods.start()
        },
        mounted() {
            this.$refs.sidebarUl.loadLists();
        },
        beforeDestroy() {
            refresher.methods.destroy()
        },
        methods: {
            onListSelected(list){
                this.$refs.mainComponent.showList(list);
            },
            onShowCreateNewList(){
                console.log('Create New List Master');
                this.$refs.mainComponent.showCreateNewList();
            },
            onListCreated(list){
                this.$refs.sidebarUl.loadLists();
                //TODO Add existing list from param
            }








        }
    }
</script>
