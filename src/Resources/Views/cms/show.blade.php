@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">User List</li>
                    <li class="breadcrumb-item active">{{$user->full_name}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{$user->profile_picture}}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$user->full_name}}</h3>

                        {{-- <p class="text-muted text-center">Software Engineer</p> --}}

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{$user->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile</b> <a class="float-right">{{$user->mobile}}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Reset Password</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Roles</strong>
                        <a class="btn-sm btn-success btn-flat" data-toggle="modal" data-target="#assign-role"><i class="fa fa-eye" title="Assign Role"></i></a>


                        <p class="text-muted">
                            @foreach($user->roles as $role)
                            <span class="tag tag-danger">{{$role->title}}</span>
                            @endforeach
                        </p>
                        <hr />

                        <strong><i class="fas fa-book mr-1"></i> Date of birth</strong>
                        <p class="text-muted">
                            {{$user->dob ? $user->dob : 'N/A'}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Gender</strong>
                        <p class="text-muted">{{$user->gender ? Str::title($user->gender) : 'N/A'}}</p>
                        <hr>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#social" data-toggle="tab">Social</a></li>
                            <li class="nav-item"><a class="nav-link" href="#payment" data-toggle="tab">Payment</a></li>
                            <li class="nav-item"><a class="nav-link" href="#device" data-toggle="tab">Device</a></li>
                            <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                            <li class="nav-item"><a class="nav-link" href="#permission" data-toggle="tab">Permission</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane" id="profile">
                                <h1>Profile</h1>
                            </div>

                            <div class="tab-pane" id="social">
                                <h1>Social</h1>
                            </div>

                            <div class="tab-pane" id="payment">
                                <h1>Payment</h1>
                            </div>

                            <div class="tab-pane" id="device">
                                <h1>Device</h1>
                            </div>

                            <div class="tab-pane" id="address">
                                <h1>Address</h1>
                            </div>

                            <div class="tab-pane active" id="permission">
                                <form method="post" action="{{route('admin.users.assign-ability', ['user' => $user->id])}}" }>
                                    <div class="col-12" id="accordion">
                                        @foreach($allAbilities as $module => $abilityGroup)
                                        <div class="card card-primary card-outline">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse-{{$module}}">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">{{Str::title($module)}}</h4>
                                                </div>
                                            </a>
                                            <div id="collapse-{{$module}}" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($abilityGroup as $ability)
                                                        <div class="col-sm-3">
                                                            <!-- checkbox -->
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name='abilities_id[]' value="{{$ability->id}}" type="checkbox" {{in_array( $ability->id, $user->abilities->pluck('id')->toArray()) ? 'checked' : ''}}>
                                                                    <label class="form-check-label">{{Str::title($ability->title)}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>





         <!-- Assign Role show -->
      <div class="modal fade" id="assign-role">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Assign Roles</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{route('admin.users.assign-role', ['user' => $user->id])}}"}>
                <div class="card-body">
                  <div class="row">
                    @foreach($allRoles as $role)
                      <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="roles_id[]" value="{{$role->id}}" {{$user->isA($role->name) ? 'checked' : ''}}>
                              <label class="form-check-label">{{$role->title}}</label>
                            </div>
                        </div>
                      </div>
                     @endforeach
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          @csrf
                          <button type="submit" class="btn btn-primary">Assign</button>                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
       <!-- /Assign Role -->
@endsection
=======
      <div class="container-fluid">
>>>>>>> 89253e0c6da8a8b75220f04e912f4d24f27ebfc6
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">User List</li>
                    <li class="breadcrumb-item active">{{$user->full_name}}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{$user->profile_picture}}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$user->full_name}}</h3>

                        {{-- <p class="text-muted text-center">Software Engineer</p> --}}

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{$user->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile</b> <a class="float-right">{{$user->mobile}}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Reset Password</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Roles</strong>
                        <a class="btn-sm btn-success btn-flat" data-toggle="modal" data-target="#assign-role"><i class="fa fa-eye" title="Assign Role"></i></a>


                        <p class="text-muted">
                            @foreach($user->roles as $role)
                            <span class="tag tag-danger">{{$role->title}}</span>
                            @endforeach
                        </p>
                        <hr />

                        <strong><i class="fas fa-book mr-1"></i> Date of birth</strong>
                        <p class="text-muted">
                            {{$user->dob ? $user->dob : 'N/A'}}
                        </p>
                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Gender</strong>
                        <p class="text-muted">{{$user->gender ? Str::title($user->gender) : 'N/A'}}</p>
                        <hr>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#social" data-toggle="tab">Social</a></li>
                            <li class="nav-item"><a class="nav-link" href="#payment" data-toggle="tab">Payment</a></li>
                            <li class="nav-item"><a class="nav-link" href="#device" data-toggle="tab">Device</a></li>
                            <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                            <li class="nav-item"><a class="nav-link" href="#permission" data-toggle="tab">Permission</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane" id="profile">
                                <h1>Profile</h1>
                            </div>

                            <div class="tab-pane" id="social">
                                <h1>Social</h1>
                            </div>

                            <div class="tab-pane" id="payment">
                                <h1>Payment</h1>
                            </div>

                            <div class="tab-pane" id="device">
                                <h1>Device</h1>
                            </div>

                            <div class="tab-pane" id="address">
                                <h1>Address</h1>
                            </div>

                            <div class="tab-pane active" id="permission">
                                <form method="post" action="{{route('admin.users.assign-ability', ['user' => $user->id])}}" }>
                                    <div class="col-12" id="accordion">
                                        @foreach($allAbilities as $module => $abilityGroup)
                                        <div class="card card-primary card-outline">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse-{{$module}}">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">{{Str::title($module)}}</h4>
                                                </div>
                                            </a>
                                            <div id="collapse-{{$module}}" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($abilityGroup as $ability)
                                                        <div class="col-sm-3">
                                                            <!-- checkbox -->
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name='abilities_id[]' value="{{$ability->id}}" type="checkbox" {{in_array( $ability->id, $user->abilities->pluck('id')->toArray()) ? 'checked' : ''}}>
                                                                    <label class="form-check-label">{{Str::title($ability->title)}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>





         <!-- Assign Role show -->
      <div class="modal fade" id="assign-role">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Assign Roles</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{route('admin.users.assign-role', ['user' => $user->id])}}"}>
                <div class="card-body">
                  <div class="row">
                    @foreach($allRoles as $role)
                      <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="roles_id[]" value="{{$role->id}}" {{$user->isA($role->name) ? 'checked' : ''}}>
                              <label class="form-check-label">{{$role->title}}</label>
                            </div>
                        </div>
                      </div>
                     @endforeach
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          @csrf
                          <button type="submit" class="btn btn-primary">Assign</button>                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
       <!-- /Assign Role -->
@endsection