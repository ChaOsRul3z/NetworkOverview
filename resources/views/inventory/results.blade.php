@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 128px;">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <form action="{{ route('inventory-search')  }}" method="post">
                    {{ csrf_field() }}
                    {{-- TODO FIX DATA BEING POSTED TO INVENTORY CONTROLLER SEARCH --}}
                    <div class="form-group">
                        <label for="date-from">Date From</label>
                        <input type="date" class="form-control" id="date-from" name="date-from" placeholder="from">
                    </div>
                    <div class="form-group">
                        <label for="date-to">Date To</label>
                        <input type="date" class="form-control" id="date-to" name="date-to" placeholder="to">
                    </div>
                    <div class="form-group">
                        <a id="deselect-types" class="btn btn-secondary btn-sm" style="margin-bottom: 5px;">Deselect All</a>
                        <select multiple class="form-control" id="types" name="types[]" style="height: 128px;">
                            @foreach(App\Models\Type::all() as $type)
                                <option value="{{ $type->id }}">{{ $type->sort->name }} - {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Search</button>
                </form>
            </div>
        </div>

    </div>
@endsection


@section('javascript')
    <script>
        $(document).ready(function () {
            $('#deselect-types').click(function () {
                $('#types option:selected').prop("selected", false);
            });

            $('#search').on("keyup", function () {
                let searchBoxValue = $(this).val().toLowerCase();
                /*
                * split array
                * remove whitespace surrounding each element
                * remove empty elements from the array
                */
                let filter = searchBoxValue.split(",").map(function (item) {
                    return item.trim()
                }).filter(v => v !== "");
                /*
                * regex filters
                */
                let matchDateRange = /\b(\d{4})[ ]-[ ](\d{4})\b/; // from(year) - to(year)
                let matchDate = /(\d{4})/; // year
                let matchColumnValue = /\b\w+[:]\s?\w+\b/; // columnName: value

                $('#devices tr').filter(function () {
                    let element = $(this);
                    let matches = false;

                    let bool;
                    filter.forEach(function (value) {
                        console.log("START");
                        console.log(value);
                        console.log(value.match(matchDateRange).length);
                        // console.log(value.match(matchDate));
                        // console.log(value.match(matchColumnValue));
                        console.log("END");
                    });

                    element.toggle(matches);

                    // let boolean;
                    //     filter.forEach(function(element) {
                    //         boolean += matchDateRange.match($(this));
                    // });

                    // console.log(element.match(matchDate));

                    // console.log(boolean);
                    // console.log($(this).text().toLowerCase().indexOf(searchBoxValue) > -1);
                    // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            function matchDate(value, date) {
                return value.toLowerCase().indexOf(date) > -1;
            }
        });

        //    TODO zoeken op naam, properties,..
        //    TODO generate list of pcs from x year or x -> y year and more
    </script>
@endsection