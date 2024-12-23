<x-layouts.header title="Barang Panel" />

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('barang.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('barang.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Barang</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Barang</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Logout button -->
                        <a class="nav-link dropdown-item d-flex align-items-center gap-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm text-gray-400"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="card shadow">
                        <div class="d-sm-flex align-items-center justify-content-between px-4 pt-4">
                            <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
                            <a href="#"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#addModal">
                                <i class="fas fa-plus fa-sm text-white-50"></i>
                                Tambah Data
                            </a>
                        </div>
                        <!-- Table Data -->
                        <div class="mb-1">
                            <div class="card-body" style="height: 450px; overflow-y: auto;">
                                <div class="table-responsive">
                                    <table class="table table-bordered"
                                        id="dataTable"
                                        width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10%">No</th>
                                                <th class="text-center" style="width: 30%">Nama Barang</th>
                                                <th class="text-center" style="width: 20%">Harga</th>
                                                <th class="text-center" style="width: 20%">Stok</th>
                                                <th class="text-center" style="width: 20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DataTables will populate this automatically -->
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- End of Add Modal -->

    <!-- Edit Modal -->
    {{-- @foreach($barang as $key => $item)
    <div class="modal fade" id="editModal{{ $key }}" tabindex="-1" aria-labelledby="editModalLabel{{ $key }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $key }}">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('barang.update', $key) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $item['name'] }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $item['price'] }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ $item['stock'] }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    @endforeach --}} <!-- End of Edit Modal -->

    <script type="text/javascript">
        $(document).ready(function() {
            $.noConflict();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize DataTable
            let table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('barang.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        render: function(data) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return `
                            <button class="btn btn-primary btn-sm edit-btn" data-id="${meta.row}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${meta.row}">Delete</button>
                        `;
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Add Modal Reset Form
            $('#addModal').on('show.bs.modal', function() {
                $('#barangForm').trigger("reset");
            });

            // Delete item
            function deleteFunc(id) {
                if (confirm("Are you sure you want to delete this item?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('barang.destroy', '') }}/" + id,
                        success: function(res) {
                            table.draw();
                        }
                    });
                }
            }

            // Form submission
            $('#barangForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('barang.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#addModal').modal('hide');
                        table.draw();
                        $('#barangForm').trigger("reset");
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            // Edit form submission
            $('.editForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var id = $(this).data('id');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('barang.update', '') }}/" + id,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#editModal' + id).modal('hide');
                        table.draw();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            // Delete button click handler
            $('#dataTable').on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                if (confirm("Are you sure you want to delete this item?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('barang.destroy', '') }}/" + id,
                        success: function(res) {
                            console.log(res);
                            table.draw();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Failed to delete item. Please try again.');
                        }

                    });
                }
            });

        });
    </script>

</body>

<x-layouts.footer />