@extends('siteadmin.layout.admin_master')
@section('title', 'Manage Subscribers')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class=""><a>Home</a></li>
                <li class="active"><a>Manage Subscribers</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box dark">
                <header>
                    <div class="icons"><i class="icon-edit"></i></div>
                    <h5>Manage Subscribers</h5>

                </header>

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissable">{!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 panel_marg">
                        <table class="table table-bordered" id="dataTables-example">
                            <thead>
                            <tr>
                                <th style="width:10%;" class="text-center">S.No</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Subscribe/<br>Unsubscribe</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            @foreach($subscriber_list as $subs_list)
                                <tr>
                                    <td class="text-center">{!!$i!!}</td>
                                    <td class="text-center">{!!$subs_list->email!!}</td>
                                    <td class="text-center">
                                        <?php if ($subs_list->status == 1) {
                                            echo "<a href='" . url('edit_news_subscriber_status/' . $subs_list->id . '/0') . "' > <i class='icon icon-ok icon-2x '></i> </a>";
                                        } else {
                                            echo "<a href='" . url('edit_news_subscriber_status/' . $subs_list->id . '/1') . "' > <i class='icon icon-ban-circle icon-2x icon-me'></i> </a>";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><a
                                                href="{!! url('delete_news_subscriber').'/'.$subs_list->id!!}"><i
                                                    class="icon icon-trash icon-2x"></i></a></td>
                                </tr>
                                <?php $i++;?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection