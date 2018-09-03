<div class="col-sm-12">
    <div class="collapse" id="collapseUnits">
        <table class="table table-hover">
            <thead>
            <tr class="row">
                <th class="col-md-1"></th>
                <th class="col-md-1 text-center">#</th>
                <th class="col-md-4">name</th>
                <th class="col-md-4">type</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody class="sortable" data-entityname="units">
            @foreach ($rack->units as $unit)
                <tr data-itemId="{{{ $unit->id }}}" class="row">
                    <td class="col-md-1 sortable-handle text-center"><span class="fa fa-sort"></span></td>
                    <td class="col-md-1 id-column text-center">{{{ $unit->id }}}</td>
                    <td class="col-md-4">{{{ $unit->name }}}</td>
                    <td class="col-md-4">{{{ $unit->type->name }}}</td>
                    <td class="col-md-2">
                        <div class="clearfix">
                            <div class="pull-right">
                                <a href="{{{ route('racks.units.edit', [$rack, $unit]) }}}" class="btn btn-sm btn-outline-warning">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </a>
                                <button data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-title="Are you sure you want to delete: {{{ $unit->name }}}?"
                                        data-body="Everything in this unit will be deleted."
                                        data-url="{{{ route('racks.units.destroy', [$rack, $unit]) }}}"
                                        class="open-DeleteModal btn btn-sm btn-outline-danger">
                                    <span class="fa fa-remove" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
