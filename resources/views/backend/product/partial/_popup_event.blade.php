<div class="modal fade modal-backend" id="modalEvent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add to event</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_product_event">
                <div class="row">
                    <div class="col-sm-3 control-label">Event:</div>
                    <div class="col-sm-9">
                        <select class="form-control" id="id_event">
                            @if(isset($events))
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn dark btn-outline btn-backend" data-dismiss="modal">Close</button>
                <button type="button" class="btn green btn-backend" id="add-to-event">Save</button>
            </div>
        </div>
    </div>
</div>