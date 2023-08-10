@extends('layouts.app')

@section('page_title')
    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" ><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Users</li>
        </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                @include('layouts.notice')
                <div class="card">
                    <div class="card-body">
                        <div class="row card-title">
                            <div class="col">
                                <h5 class="">Users </h5>
                            </div>

                        </div>


                      <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Names</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Activities</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->names }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->activities->count() }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <!--
                                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Preview">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            -->

                                            <a href="{{ route('user.activities', $user->uid) }}" class="btn btn-sm btn-primary"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="User Activities"
                                                {{-- data-bs-toggle="modal" data-bs-target="#verticalycentered" --}}
                                                >
                                                <i class="bi bi-list-columns"></i>
                                            </a>

                                            <!--
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                            -->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center"><b>No data available</b></p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                      <!-- End Table with stripped rows -->

                      {{ $users->links() }}
                    </div>
                  </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Activity for <span id="dateadded"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>

            </div>

        </div>
      </div><!-- End Vertically centered Modal-->

@endsection

@section('custom_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.openPopup').on('click',function(){
            var dataURL = $(this).attr('data-href');
            console.log('works')
            console.log(dataURL)

            // $('#myModal').modal({show:true});

            $('.modal-body').load(dataURL,function(){
                console.log('loaded')

            });
        });
    });
    </script>
@endsection
