<div class="modal" role="dialog" id="userAds">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$user->email}} skelbimai</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-4">
                        <h5>Pavadinimas</h5>
                    </div>
                    <div class="col col-4">
                        <h5>Aprašas</h5>
                    </div>
                    <div class="col">
                        <h5>Kaina</h5>
                    </div>
                    <div class="col">
                        <h5>Baigiasi</h5>
                    </div>
                </div>
                @foreach ($user->ads as $ad)
                    <div class="row">
                        <div class="col col-4">
                            <a href="/ads/{{$ad->id}}">{{$ad->name}}</a>
                        </div>
                        <div class="col col-4" style="max-height: 100px; white-space: nowrap; overflow: hidden; text-overflow-ellipsis: ellipsis;">
                                {{$ad->description}}
                        </div>
                        <div class="col">
                            {{$ad->price}}
                        </div>
                        <div class="col">
                            {{$ad->expiration}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>
