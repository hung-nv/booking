<div class="modal fade modal-backend" id="modalAttribute" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add @{{ masterAttributeName }}</h4>
            </div>
            <div class="modal-body">
                <div class="alert-error"></div>
                <div class="form-group">
                    <div class="col-sm-3 control-label">Name:</div>
                    <div class="col-sm-8">
                        <input type="text" v-model="attributeName" class="form-control" v-on:keyup="enterAddAttribute" />
                    </div>
                </div>
                <div class="form-group text-center" style="">
                    <button type="button" class="btn dark btn-outline btn-backend" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green btn-backend" v-on:click="addAttribute">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>