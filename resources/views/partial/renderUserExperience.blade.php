@if(count($userExpData) > 0)
    @foreach ($userExpData as $expData)
        <tr>
            <td>
                {{ $expData->role }}
            </td>
            <td>
                {{ $expData->from_year }}-{{$expData->to_year}}
            </td>
            <td>
                {{$expData->clinic_name}}
            </td>
            <td class="text-center p-0">
                <a href="javascript:void(0)" data-id="{{ $expData->id }}" class="ic-close btn-close  [ d-inline-block align-middle ml-1 ] delete_experience">
                </a>
            </td>
        </tr>
    @endforeach
@endif