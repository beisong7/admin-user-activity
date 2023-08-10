<form action="{{ route('activity.update', $activity->uid) }}" method="post">
    @csrf
    {{ method_field('put') }}

    @if(!empty($type))
        <input type="hidden" name="type" value="private">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
    @endif

    <div class="form-group">
        <label for="">* Title</label>
        <input type="text" name="title" class="form-control" value="{{ $activity->title}}" required>
    </div>
    <br>

    <div class="form-group">
        <label for="">* Description</label>
        <input type="text" name="description" class="form-control" value="{{ $activity->description }}" required>
    </div>
    <br>

    <div class="form-group">
        <label for="">* Date</label>
        <input type="date" name="date" class="form-control" value="{{ $activity->date }}" required>
    </div>

    <br>
    <div class="" style="width: 70px; padding: 10px; background:#333">
        <img src="{{ $activity->img }}" style="width: 100%" alt="">
    </div>
    <br>
    <div class="form-group mb-3">
        <label for="">Image</label>
        <input type="file" name="image" class="form-control" >
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Update Activity</button>
    <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Close</button>
</form>
