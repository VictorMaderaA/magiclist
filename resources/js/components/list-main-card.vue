<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mb-3">
<!--                    <h3 class="card-header">{{$list->name}}</h3>-->
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                    </div>

                    <img style="height: 200px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158bd1d28ef%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158bd1d28ef%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22129.359375%22%20y%3D%2297.35%22%3EImage%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image">
                    <div class="card-body">
                        <p class="card-text">Contenido:</p>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" v-for="item in listItems.activities">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm">
                                        {{item.name}}
                                    </div>
                                    <div class="col-sm">
                                        {{item.description}}
                                    </div>
                                    <div class="col-sm">

                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <button type="button" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="left" title="" data-original-title="Tooltip on left">Left</button>

                                            <button type="button" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">Top</button>

                                            <button type="button" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on bottom">Bottom</button>

                                            <button type="button" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="Tooltip on right">Right</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
<!--                        @endforeach-->

                    </ul>

                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "list-main-card",
        props: {
            listimport: Object
        },
        data() {
            return {
                listItems: null,
            }
        },
        mounted() {
            console.log('Mounted')
            this.listItems = this.listimport;
        }
    }
</script>

<style scoped>

</style>
