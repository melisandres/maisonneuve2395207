@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-8">
            @lang('lang.uploads_index_heading')
        </div>
        <div class="col-4">
            <a href="{{ route('upload.create')}}" class="btn btn-primary">@lang('lang.text_add')</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('lang.text_files')</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('lang.text_student')</th>
                                <th>@lang('lang.text_file_name')</th>
                                <th>@lang('lang.text_download')</th>
                                <th><!-- Modify --></th>
                                <th><!-- Delete --></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($uploads as $upload)
                                <tr>
                                    <td>{{ $upload->hasUser->name }}</td>
                                    <td>{{ $upload->title }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('uploads.download', ['filename' => $upload->file_path]) }}">@lang('lang.text_download')</a>
                                    </td>
                                    @if(Auth::check() && Auth::user()->id == $upload->user_id)
                                        <td>
                                            <!-- Modify button for the logged-in user -->
                                            <a href="{{ route('upload.edit', $upload->id) }}" class="btn btn-success">@lang('lang.text_edit')</a>
                                        </td>
                                        <td>
                                            <div class="col-4">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-upload-id="{{ $upload->id }}">
                                                Effacer
                                                </button>
                                            </div>
                                        </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger">@lang('lang.files_none')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $uploads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('lang.text_delete_heading')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @lang('lang.text_delete_notification')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.text_no')</button>

                <form method="POST" action="{{ route('upload.delete', ':id') }}" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Effacer" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle click on delete button to update the delete form action
        var deleteButtons = document.querySelectorAll('.delete-btn');
        var deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var uploadId = button.getAttribute('data-upload-id');
                var actionUrl = "{{ route('upload.delete', ':id') }}".replace(':id', uploadId);
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    });
</script>



<!-- Modal
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Effacer la donnée</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Etes-vous sûr de efffacer la donnée?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>

        <form method="POST" action="{{ route('upload.delete', $upload->id) }}">
            @csrf
            @method('DELETE')



            <input type="submit" value="Effacer" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
</div> -->
@endsection