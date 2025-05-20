@extends('layout')
@section('title')
    <title>{{ $seo_setting->seo_title }}</title>
    <meta name="title" content="{{ $seo_setting->seo_title }}">
    <meta name="description" content="{!! strip_tags(clean($seo_setting->seo_description)) !!}">
@endsection

@section('body-content')
<main>
     <!-- banner-part-start  -->

     <section class="inner-banner">
     <div class="inner-banner-img" style=" background-image: url({{ asset($breadcrumb) }}) ;"></div>
        <div class="container">
        <div class="col-lg-12">
            <div class="inner-banner-df">
                <h1 class="inner-banner-taitel">{{ __('translate.Contact Us') }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('translate.Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('translate.Contact Us') }}</li>
                    </ol>
                </nav>
            </div>
            </div>
        </div>
    </section>
    <!-- banner-part-end -->



    <!-- contact-us-part-start -->
    <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 contact-us-wight ">
                    <h3 class="contact-us-taitel">{{ $contact_us->title }}</h3>


                    <div class="contact-us-item">
                        <div class="contact-us-inner">
                            <div class="icon">
                                <span>
                                    <svg width="52" height="52" viewBox="0 0 52 52" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M40.1818 0H11.8182C8.68496 0.00375309 5.68114 1.25008 3.46561 3.46559C1.25008 5.6811 0.00375312 8.6849 0 11.8181V30.7271C0.00343797 33.4504 0.945668 36.0894 2.66788 38.1991C4.39009 40.3088 6.78697 41.7602 9.45455 42.3088V49.636C9.45448 50.0639 9.57059 50.4838 9.79048 50.8509C10.0104 51.218 10.3258 51.5186 10.7031 51.7204C11.0804 51.9223 11.5054 52.018 11.9329 51.9972C12.3603 51.9765 12.774 51.8401 13.13 51.6026L26.7091 42.5452H40.1818C43.315 42.5414 46.3189 41.2951 48.5344 39.0796C50.7499 36.8641 51.9962 33.8603 52 30.7271V11.8181C51.9962 8.6849 50.7499 5.6811 48.5344 3.46559C46.3189 1.25008 43.315 0.00375309 40.1818 0ZM35.4545 28.3634H16.5455C15.9186 28.3634 15.3174 28.1144 14.8741 27.6712C14.4308 27.2279 14.1818 26.6267 14.1818 25.9998C14.1818 25.373 14.4308 24.7718 14.8741 24.3285C15.3174 23.8852 15.9186 23.6362 16.5455 23.6362H35.4545C36.0814 23.6362 36.6826 23.8852 37.1259 24.3285C37.5692 24.7718 37.8182 25.373 37.8182 25.9998C37.8182 26.6267 37.5692 27.2279 37.1259 27.6712C36.6826 28.1144 36.0814 28.3634 35.4545 28.3634ZM40.1818 18.909H11.8182C11.1913 18.909 10.5901 18.6599 10.1468 18.2167C9.70357 17.7734 9.45455 17.1722 9.45455 16.5453C9.45455 15.9185 9.70357 15.3173 10.1468 14.874C10.5901 14.4307 11.1913 14.1817 11.8182 14.1817H40.1818C40.8087 14.1817 41.4099 14.4307 41.8532 14.874C42.2964 15.3173 42.5455 15.9185 42.5455 16.5453C42.5455 17.1722 42.2964 17.7734 41.8532 18.2167C41.4099 18.6599 40.8087 18.909 40.1818 18.909Z" />
                                    </svg>
                                </span>
                            </div>

                            <div class="text">
                                <h4>{{ __('translate.Live Chat') }}</h4>

                                <p>{{ __('translate.Wait time of ~10 minutes.') }}</p>
                            </div>
                        </div>
                        <div class="contact-us-inner">
                            <div class="icon">
                                <span>
                                    <svg width="47" height="42" viewBox="0 0 47 42" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4 0C1.79086 0 0 1.79086 0 4V9.79351L21.5701 25.4809C22.6221 26.2459 24.0472 26.2459 25.0991 25.4809L46.6667 9.7954V4C46.6667 1.79086 44.8758 0 42.6667 0H4ZM46.6667 12.2684L26.2755 27.0983C24.5222 28.3734 22.147 28.3734 20.3938 27.0983L0 12.2665V38C0 40.2091 1.79086 42 4 42H42.6667C44.8758 42 46.6667 40.2091 46.6667 38V12.2684Z" />
                                    </svg>
                                </span>
                            </div>

                            <div class="text">
                                <h4>{{ __('translate.Email Us') }}</h4>

                                <p>{{ $contact_us->email }}</p>
                            </div>
                        </div>
                    </div>


                    <div class="contact-box">
                        <a href="tel:{{ $contact_us->phone }}">{{ $contact_us->phone }}</a>

                        <div class="location">
                            <a href="javascript:;">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 21.25C5.58579 21.25 5.25 21.5858 5.25 22C5.25 22.4142 5.58579 22.75 6 22.75V21.25ZM18 22.75C18.4142 22.75 18.75 22.4142 18.75 22C18.75 21.5858 18.4142 21.25 18 21.25V22.75ZM18.75 9.5C18.75 11.2065 17.6599 13.4136 16.1547 15.2468C15.4148 16.1481 14.6072 16.9179 13.8465 17.4554C13.0624 18.0094 12.4227 18.25 12 18.25V19.75C12.8898 19.75 13.8438 19.294 14.7121 18.6804C15.6038 18.0504 16.5071 17.1815 17.314 16.1987C18.9026 14.2638 20.25 11.7209 20.25 9.5H18.75ZM12 18.25C11.5925 18.25 10.9595 17.9993 10.171 17.4074C9.409 16.8353 8.59932 16.0178 7.85679 15.0668C6.34675 13.1327 5.25 10.825 5.25 9.11111H3.75C3.75 11.3246 5.09075 13.9614 6.67446 15.9899C7.4788 17.0201 8.38006 17.9385 9.27041 18.6069C10.1343 19.2555 11.095 19.75 12 19.75V18.25ZM5.25 9.11111C5.25 5.48059 8.47857 2.75 12 2.75V1.25C7.78944 1.25 3.75 4.51941 3.75 9.11111H5.25ZM12 2.75C15.4938 2.75 18.75 5.45503 18.75 9.5H20.25C20.25 4.54497 16.2382 1.25 12 1.25V2.75ZM14.25 9C14.25 10.2426 13.2426 11.25 12 11.25V12.75C14.0711 12.75 15.75 11.0711 15.75 9H14.25ZM12 11.25C10.7574 11.25 9.75 10.2426 9.75 9H8.25C8.25 11.0711 9.92893 12.75 12 12.75V11.25ZM9.75 9C9.75 7.75736 10.7574 6.75 12 6.75V5.25C9.92893 5.25 8.25 6.92893 8.25 9H9.75ZM12 6.75C13.2426 6.75 14.25 7.75736 14.25 9H15.75C15.75 6.92893 14.0711 5.25 12 5.25V6.75ZM6 22.75H18V21.25H6V22.75Z" />
                                    </svg>
                                </span>

                                {{ $contact_us->address }}
                            </a>
                        </div>
                    </div>


                    <div class="contact-share">
                        <div class="icon">
                            <a href="https://snapchat.com/t/lVLzQyeB" target="_blank">
                                <img src="{{ asset('icons/snap.png') }}" alt="SnapChat" width="27" height="27">
                            </a>
                        </div>

                        <div class="icon">
                            <a href="https://www.tiktok.com/@wasil.ksa?_t=ZS-8w9sK5UCf28&_r=1" target="_blank">
                                <!-- تغيير الحجم مباشرة داخل عنصر الصورة -->
                                <img src="{{ asset('icons/images.png') }}" alt="TikTok" width="27" height="27">
                            </a>
                        </div>

                        <div class="icon">
                            <a href="{{ $setting->instagram }}">
                               <span>
                               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 6C1.25 3.37665 3.37665 1.25 6 1.25H18C20.6234 1.25 22.75 3.37665 22.75 6V18C22.75 20.6234 20.6234 22.75 18 22.75H6C3.37665 22.75 1.25 20.6234 1.25 18V6ZM6 2.75C4.20507 2.75 2.75 4.20507 2.75 6V18C2.75 19.7949 4.20507 21.25 6 21.25H18C19.7949 21.25 21.25 19.7949 21.25 18V6C21.25 4.20507 19.7949 2.75 18 2.75H6Z" />
                                <path d="M19 6C19 6.55228 18.5523 7 18 7C17.4477 7 17 6.55228 17 6C17 5.44772 17.4477 5 18 5C18.5523 5 19 5.44772 19 6Z" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 7.75C9.65279 7.75 7.75 9.65279 7.75 12C7.75 14.3472 9.65279 16.25 12 16.25C14.3472 16.25 16.25 14.3472 16.25 12C16.25 9.65279 14.3472 7.75 12 7.75ZM6.25 12C6.25 8.82436 8.82436 6.25 12 6.25C15.1756 6.25 17.75 8.82436 17.75 12C17.75 15.1756 15.1756 17.75 12 17.75C8.82436 17.75 6.25 15.1756 6.25 12Z" >
                                </svg>

                               </span>
                            </a>
                        </div>
                    </div>


                </div>

                <div class="col-lg-6">
                    <div class="get-in-touch">
                        <h3 class="get-in-touch-taitel">{{ __('translate.Get in Touch') }}</h3>

                        <form action="{{ route('store-contact-message') }}" method="POST">
                            @csrf

                            <div class="get-in-touch-form-item">
                                <div class="get-in-touch-form-inner">
                                    <label for="exampleFormControlInput1" class="form-label">{{ __('translate.Name') }}
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="{{ __('translate.Name') }}" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="get-in-touch-form-inner">
                                    <label for="exampleFormControlInput2" class="form-label">{{ __('translate.Phone number') }}
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" id="exampleFormControlInput2"
                                        placeholder="{{ __('translate.Phone number') }}" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="get-in-touch-form-item">
                                <div class="get-in-touch-form-inner">
                                    <label class="form-label">{{ __('translate.Email') }}
                                        <span>*</span>
                                    </label>
                                    <input type="email" class="form-control" id="exampleFormControlInput4"
                                        placeholder="{{ __('translate.Email') }}" value="{{ old('email') }}" name="email">
                                </div>
                                <div class="get-in-touch-form-inner">
                                    <label for="exampleFormControlInput3" class="form-label">{{ __('translate.Subject') }}
                                        <span>*</span>
                                    </label>
                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                        placeholder="{{ __('translate.Subject') }}" name="subject" value="{{ old('subject') }}">
                                </div>
                            </div>
                            <div class="get-in-touch-form-item">
                                <div class="get-in-touch-form-inner">
                                    <label for="exampleFormControlInput6" class="form-label">{{ __('translate.Message') }}
                                        <span>*</span>
                                    </label>
                                    <textarea class="form-control" id="exampleFormControlTextarea6" rows="8"
                                        placeholder="{{ __('translate.Type Here') }}" name="message">{{ old('message') }}</textarea>
                                </div>

                            </div>

                            @if($google_recaptcha->status==1)
                                <div class="get-in-touch-form-item">
                                    <div class="get-in-touch-form-inner">
                                        <div class="g-recaptcha" data-sitekey="{{ $google_recaptcha->site_key }}"></div>
                                    </div>
                                </div>
                            @endif


                            <button type="submit" class="thm-btn-two">{{ __('translate.Send Message') }}</button>

                        </form>

                    </div>

                </div>
            </div>

        </div>

        <div class="contact-map" >

            <iframe src="{{ $contact_us->map_code }}" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </section>
    <!-- contact-us-part-end -->

</main>

@endsection

@push('js_section')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endpush
