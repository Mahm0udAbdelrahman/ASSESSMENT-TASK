@extends('admin.layouts.app')
@section('content')
    @push('cs')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    @endpush
    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

        <!-- Internal Datatables JS -->
        <script src="{{ asset('dashboard/assets/js/datatables.js') }}"></script>
    @endpush
    <!-- Start:: row-3 -->
    <div class="d-block align-items-center justify-content-between page-header-breadcrumb">

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Responisve Modal Datatable
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="responsivemodal-DataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <a href="{{ route('task.create') }}" class="btn btn-primary">Create</a>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                     <th>{{ __('Status') }}</th>
                                     <th>{{ __('Due Date') }}</th>

                                    <th>{{ __('Options') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $task->category->name }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        @if ($task->status == 1)
                                            {{ __('pending') }}
                                        @else
                                            {{ __('completed') }}
                                        @endif
                                    </td>
                                    <td>{{ $task->due_date }}</td>

                                    <td>
                                        @if($task->deleted_at)
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $task->id }}">
                                                <i class="fa fa-undo"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#forceDeleteModal{{ $task->id }}">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        @else
                                        <div class="d-flex">
                                            <a href="{{ route('task.edit', $task->id) }}" class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                            <a href="{{ route('task.show', $task->id) }}"
                                                class="btn btn-success  me-2"><i class="fa fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">تأكيد الحذف</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">هل أنت متأكد أنك تريد حذف هذا العنصر؟</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">إلغاء</button>
                                                <form method="POST" action="{{ route('task.destroy', $task->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Restore Confirmation Modal -->
                                <div class="modal fade" id="restoreModal{{ $task->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="restoreModalLabel{{ $task->id }}">استرجاع</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">هل أنت متأكد أنك تريد استرجاع هذا العنصر؟</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">إلغاء</button>
                                                <form method="POST" action="{{ route('task.restore', $task->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">استرجاع</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Force Delete Confirmation Modal -->
                                <div class="modal fade" id="forceDeleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="forceDeleteModalLabel{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="forceDeleteModalLabel{{ $task->id }}">حذف نهائي</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">هل أنت متأكد أنك تريد حذف هذا العنصر نهائيًا؟</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">إلغاء</button>
                                                <form method="POST" action="{{ route('task.forceDelete', $task->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: row-3 -->

@endsection
