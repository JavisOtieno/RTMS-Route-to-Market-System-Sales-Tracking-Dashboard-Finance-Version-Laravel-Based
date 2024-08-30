<!-- resources/views/partials/team-select.blade.php -->
@if (auth()->user()->usertype == "admin")
<div class="form-group">
    <label for="team_id" class="form-label">Team</label>
    <select name="team_id" class="form-control form-select select2" data-bs-placeholder="Select Team">
        <option value="0">None</option>
        @foreach($teams as $team)
        {{-- <option value="{{ $team['id'] }}" {{ old('team_id', '') == $team['id'] ? 'selected' : '' }}>
            {{ $team['name'] }}
        </option> --}}
        <option {{(isset($user)?old('territory_id',$user['territory_id']):old('territory_id'))==$team['id']? 'selected':''}}
         value="{{$team['id']}}">{{$team['name']}}</option>

        @endforeach
    </select>
</div>
@endif
