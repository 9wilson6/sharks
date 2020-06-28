@extends('layouts.masterback')
@section('title', 'My Bookmarks: '.defaultsettings()['sitename'])
@section('heading', 'My Bookmarks')
@section('content')
<div class="col-lg-12">
    <p>You need to be signed up to HomeworkBubble membership plan to use this feature <a href="#">Click Here to Learn More</a></p>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th scope="col">Project # </th>
            <th scope="col">Project Title </th>
            <th scope="col">Bookmarked On </th>
            <th scope="col">Delete</th>
        </tr>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</div>
@stop