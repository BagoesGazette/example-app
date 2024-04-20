<div class="hstack flex-wrap gap-1">
    @isset($edit)
        <a  href="{{ $edit }}" class="btn btn-warning bg-gradient btn-sm waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
            <i class="ri-edit-line"></i>
        </a>
    @endisset

    @isset($destroy)
        <a class="btn btn-danger bg-gradient btn-sm waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="Delete(this.id)" id="{{ $destroy }}"> <i class="ri-delete-bin-line"></i></a>
    @endisset

    @isset($detail)
        <a  href="{{ $detail }}" class="btn btn-success bg-gradient btn-sm waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
            <i class="ri-information-line"></i>
        </a>
    @endisset

    @isset($access)
        <a href="{{ $access }}" class="btn btn-success bg-gradient btn-sm waves-effect"><i class="icon-lock"></i> Access</a>
    @endisset

    @isset($pdf)
        <a href="{{ $pdf }}" target="_blank" class="btn btn-danger bg-gradient btn-sm waves-effect"><i class="ri-file-pdf-line"></i></a>
    @endisset

    @isset($approve)
        <a class="btn btn-success bg-gradient btn-sm waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="Approval" onclick="Approve(this.id)" id="{{ $approve }}"> <i class="ri-checkbox-circle-line"></i></a>
    @endisset

    @isset($notif)
        <a class="btn btn-info bg-info btn-sm waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="Notification" onclick="Notification(this.id)" id="{{ $notif }}"> <i class="ri-send-plane-line"></i></a>
    @endisset
</div>