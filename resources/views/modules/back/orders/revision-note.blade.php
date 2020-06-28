<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i><strong>Revision status</strong>
    </div>
    <style>
        th {
            background-color: blue;
            color: white;
        } 
    </style>
    <div class="panel-body">    
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Revision instructions</th>
                    <th>Provision</th>
                    <th>Revision Upload</th>
                    <th>Revision request date</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $i = 0;
            ?>
            @foreach($revisions as $revision)
            <?php
              $i++;
            ?>
                <tr>
                    <td><strong>{{ $i }}.</strong></td>
                    <td width="41%">{{ $revision->instruction }}</td>
                    <td width="17%">{{ $revision->provision }}</td>
                    <td width="25%"><a href="{{ url('/account/getrevision-upload') }}/{{ $revision->upload }}/{{ $order_id->id }}">{{ $revision->upload }}</a></td>
                    <td width="17%">{{ $revision->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>