@extends('page')

@section('title', 'Профиль')

@section('content_header')Профиль@stop

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('put') }}
                <div class="tab-content">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Информация пользователя:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Фото</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                                                <div class="kt-avatar__holder" style="background-image: url('{{ $user->getPhotoPath() }}');"></div>
                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                    <i class="fa fa-pen"></i>
                                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg">
                                                </label>
                                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                                            <i class="fa fa-times"></i>
                                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-lg-9 ml-lg-auto">
                                                <button type="submit" class="btn btn-brand btn-bold">Сохранить </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
