@if (Session::has(config('setting.key_add_cart'))
    || Session::has(config('setting.key_update_cart'))
    || Session::has(config('setting.key_remove_cart'))
    || Session::has(config('setting.key_order'))
    || Session::has(config('setting.key_review')))
    @php
        $keyMessage = Session::has(config('setting.key_add_cart'))
            ? config('setting.key_add_cart')
            : (Session::has(config('setting.key_update_cart'))
                ? config('setting.key_update_cart')
                : config('setting.key_remove_cart'));
        if (Session::has(config('setting.key_order')))
            $keyMessage = config('setting.key_order');
        else if (Session::has(config('setting.key_review')))
            $keyMessage = config('setting.key_review');
    @endphp
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('messages.notification')}}</h5>
                </div>
                <div class="modal-body">
                    {{ Session::get($keyMessage)}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endif
