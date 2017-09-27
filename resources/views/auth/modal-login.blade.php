<!-- Login Modal -->
<div class="modal fade" id="dlgLogin" tabindex="-1" role="dialog" aria-labelledby="dlgLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-group">
                <div class="card p-4">
                    <button type="button" class="close ml-auto d-block d-lg-none" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="card-body">
                        @include('auth.components.login')
                    </div>
                </div>
                <div class="card text-white bg-primary p-4 d-none d-lg-flex" style="width:44%">
                    <button type="button" class="close ml-auto text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="card-body text-center">
                        @include('auth.components.signup')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
