<template>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info fa-fw"></i><strong>Revision status</strong>
    </div>    
    <div class="revision panel-body">
        <div class="revision table-responsive">
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
                    <tr v-for="(revision, index) in orderdetails.revisions" :key="index">
                        <td><strong></strong></td>
                        <td width="38%">{{ revision.instruction }}</td>
                        <td width="17%">{{ revision.provision }}</td>
                        <td v-if="revision.upload == 'noattachement'" width="25%"><i>No attachment</i></td>
                        <td width="25%" v-else><a :href="'/home/orders/download-revision/'+orderdetails.id+'/'+revision.upload">{{ revision.upload }}</a></td>
                        <td width="20%">{{ revision.provision }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            orderdetails: 'GetOrderDetails'
        })
    }
}
</script>

<style>
    div.revision th {
        background-color: blue;
        color: white;
    } 
</style>