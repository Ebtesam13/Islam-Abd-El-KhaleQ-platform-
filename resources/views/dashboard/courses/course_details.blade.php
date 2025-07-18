@extends('dashboard.partials.layout')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid py-5 mb-5 page-header">
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <!-- Alerts Section -->
            <div class="row">
                @if (session('alert-success'))
                    <div class="container alert alert-success" role="alert">
                        {{ session('alert-success') }}
                    </div>
                @endif

                @if (session('alert-danger'))
                    <div class="container alert alert-danger" role="alert">
                        {{ session('alert-danger') }}
                    </div>
                @endif

                @if (Session::has('message'))
                    @foreach (Session::get('message') as $class => $message)
                        <p class="alert {{ $class }}">{{ $message }}</p>
                    @endforeach
                @endif
            </div>

            <!-- Course Info Section -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('img/about.jpg') }}" class="img-fluid h-100 w-100" alt="Course Image" style="object-fit: cover;">
                            </div>

                            <div class="col-md-8">
                                <div class="card-body p-4 h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <h3 class="fw-bold mb-3">{{ $course->name }}</h3>
                                        <p class="text-muted mb-4" style="font-size: 15px;">
                                            {{ $course->description }}
                                        </p>
                                    </div>
                                    <div class="row text-center border-top pt-3 mt-3">
                                        <div class="col-4">
                                            <i class="fa fa-user-tie text-primary mb-1"></i>
                                            <div style="font-size: 14px;">{{ config('app.app_author') }}</div>
                                        </div>
                                        <div class="col-4 border-start border-end">
                                            <i class="fa fa-clock text-primary mb-1"></i>
                                            <div style="font-size: 14px;">{{ $course->hours }} Hrs</div>
                                        </div>
                                        <div class="col-4">
                                            <i class="fa fa-user text-primary mb-1"></i>
                                            <div style="font-size: 14px;">{{ count($course->users) }} Students</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Units Section -->
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="mb-3" style="color:#00b6c8">Units List</h4>

                    <div class="row g-2  justify-content-end align-items-end">
                        <div class="col-12 col-md-3">
                            <input type="text" id="unitSearch" class="form-control rounded-pill py-2" placeholder="Search by name..." />
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{ route('dashboard.dashboard_units.create', ['id' => $course->id]) }}"
                            class="btn btn-outline-success rounded-pill w-100 py-2">
                                + Add New Unit
                            </a>
                        </div>
                    </div>

                </div>


                <div class="table-responsive" style="overflow-x: auto;">
                    <table class="table table-bordered text-center align-middle mb-0" id="unitsTable">
                        <thead class="table-light">
                            <tr style="color:#fff;background:#00b6c8">
                                <th style="cursor: pointer; background: #00b6c8; color: #fff;" onclick="sortTable(0)">
                                    ID <i id="sort-id" class="fas fa-sort"></i>
                                </th>
                                <th style="cursor: pointer; background: #00b6c8; color: #fff;" onclick="sortTable(1)">
                                    Name <i id="sort-name" class="fas fa-sort"></i>
                                <th style="cursor: pointer; background: #00b6c8; color: #fff;">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="unitTableBody">
                            @foreach ($course->units as $unit)
                                <tr>
                                    <td>{{ $unit->id }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.units.show', ['unit' => $unit->id]) }}" class="btn btn-outline-main rounded-pill py-9">Show</a>
                                        <a href="#" class="btn  btn-outline-warning rounded-pill py-9">Edit</a>
                                        <!-- <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE') -->
                                            <button  class="btn  btn-outline-danger rounded-pill py-9" onclick="return confirm('Are you sure?')">Delete</button>
                                        <!-- </form> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center flex-wrap">
                    <div class="text-muted small" id="paginationInfo">Showing 0 to 0 of 0 entries</div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0" id="paginationControls"></ul>
                    </nav>
                </div>
            </div>

            <!-- Script -->
            <script>
                const rowsPerPage = 10;
                let currentPage = 1;
                let currentSort = { col: null, asc: true };
                const tbody = document.getElementById("unitTableBody");
                const paginationInfo = document.getElementById("paginationInfo");
                const paginationControls = document.getElementById("paginationControls");

                let allRows = Array.from(tbody.querySelectorAll("tr"));
                let filteredRows = [...allRows];

                function showPage(page) {
                    currentPage = page;
                    const total = filteredRows.length;
                    const totalPages = Math.ceil(total / rowsPerPage);
                    const start = (page - 1) * rowsPerPage;
                    const end = Math.min(start + rowsPerPage, total);

                    tbody.innerHTML = "";
                    for (let i = start; i < end; i++) {
                        tbody.appendChild(filteredRows[i]);
                    }

                    paginationInfo.textContent = `Showing ${start + 1} to ${end} of ${total} entries`;
                    renderPaginationControls(totalPages);
                }

                function renderPaginationControls(totalPages) {
                    paginationControls.innerHTML = "";

                    const createPageItem = (label, page, disabled = false, active = false) => {
                        const li = document.createElement("li");
                        li.className = `page-item ${disabled ? 'disabled' : ''} ${active ? 'active' : ''}`;
                        li.innerHTML = `<a class="page-link" href="#">${label}</a>`;
                        if (!disabled && page !== null) {
                            li.addEventListener("click", e => {
                                e.preventDefault();
                                showPage(page);
                            });
                        }
                        return li;
                    };

                    paginationControls.appendChild(createPageItem("«", currentPage - 1, currentPage === 1));

                    const maxVisible = 5;
                    let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
                    let endPage = Math.min(startPage + maxVisible - 1, totalPages);

                    if (endPage - startPage < maxVisible - 1) {
                        startPage = Math.max(1, endPage - maxVisible + 1);
                    }

                    if (startPage > 1) {
                        paginationControls.appendChild(createPageItem(1, 1));
                        if (startPage > 2) {
                            paginationControls.appendChild(createPageItem("...", null, true));
                        }
                    }

                    for (let i = startPage; i <= endPage; i++) {
                        paginationControls.appendChild(createPageItem(i, i, false, i === currentPage));
                    }

                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) {
                            paginationControls.appendChild(createPageItem("...", null, true));
                        }
                        paginationControls.appendChild(createPageItem(totalPages, totalPages));
                    }

                    paginationControls.appendChild(createPageItem("»", currentPage + 1, currentPage === totalPages));
                }

                function sortTable(colIndex) {
                    const isSame = currentSort.col === colIndex;
                    currentSort.asc = isSame ? !currentSort.asc : true;
                    currentSort.col = colIndex;

                    filteredRows.sort((a, b) => {
                        const aText = a.children[colIndex].textContent.trim().toLowerCase();
                        const bText = b.children[colIndex].textContent.trim().toLowerCase();
                        return currentSort.asc
                            ? aText.localeCompare(bText, undefined, { numeric: true })
                            : bText.localeCompare(aText, undefined, { numeric: true });
                    });

                    showPage(1);
                    updateSortIcons();
                }

                function updateSortIcons() {
                    const idIcon = document.getElementById("sort-id");
                    const nameIcon = document.getElementById("sort-name");

                    idIcon.className = "fas fa-sort";
                    nameIcon.className = "fas fa-sort";

                    if (currentSort.col === 0) {
                        idIcon.className = currentSort.asc ? "fas fa-sort-up" : "fas fa-sort-down";
                    } else if (currentSort.col === 1) {
                        nameIcon.className = currentSort.asc ? "fas fa-sort-up" : "fas fa-sort-down";
                    }
                }

                document.getElementById("unitSearch").addEventListener("input", function () {
                    const val = this.value.toLowerCase();
                    filteredRows = allRows.filter(row =>
                        row.children[1].textContent.toLowerCase().includes(val)
                    );
                    showPage(1);
                });

                window.addEventListener("DOMContentLoaded", () => {
                    allRows = Array.from(document.querySelectorAll("#unitTableBody tr"));
                    filteredRows = [...allRows];
                    showPage(1);
                });
            </script>

        </div>
    </div>
    <!-- About End -->
@endsection
