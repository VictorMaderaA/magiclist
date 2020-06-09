<template>

</template>

<script>
    export default {
        name: "AuthRefresher",
        data () {
            return {
                timer: ''
            }
        },
        created () {
            this.refreshToken();
            this.timer = setInterval(function () {
                this.refreshToken();
            }.bind(this), 600000);
        },
        beforeDestroy () {
            clearInterval(this.timer)
        },
        methods: {
            refreshToken(){
                this.reqAddMedia();
            },
            reqAddMedia: async function () {
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
            cancelAutoUpdate () { clearInterval(this.timer) }
        }
    }
</script>
