<div class="responsive-container-block blocks wow fadeIn">
    @foreach($testimonialData as $data)
    <div class="responsive-cell-block wk-desk-1 wk-tab-1 wk-mobile-1 wk-ipadp-1 content" wire:key ="{{$data->id}}">
        <p class="text-blk info-block">
           {{ strip_tags($data->description) }}
        </p>
        <div class="responsive-container-block person">
            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12 icon-block">
                <img class="profile-img"
                    src="{{ asset('storage/'. $data->avatar)}}">
            </div>
            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12 text-block">
                <p class="text-blk name">
                    {{ $data->Client_name }}
                </p>
                <p class="text-blk desig">
                    {{ $data->position_title.' '. 'at' . ' '. $data->company_name }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
