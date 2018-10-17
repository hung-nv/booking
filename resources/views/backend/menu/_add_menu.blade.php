<div class="modal fade modal-backend" id="modalAddMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Menu</h4>
            </div>
            <div class="modal-body">
                <div class="show-error"></div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 control-label">Menu Name:</div>
                        <div class="col-sm-8">
                            <input name="menu_name" v-model="nameMenu" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <div class="row">
                        <button type="button" class="btn dark btn-outline btn-backend" data-dismiss="modal">Close</button>
                        <button type="button" class="btn green btn-backend" v-on:click="createMenu">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>