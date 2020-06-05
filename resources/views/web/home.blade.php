@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="app">
            <lists-index :importedList="{{ $lists }}"></lists-index>
        </div>

    </div>
@endsection
<script>
    import ListsIndex from "../../js/components/lists-index";
    export default {
        components: {ListsIndex}
    }
</script>
