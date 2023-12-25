<div>
    @if($message === true)
        <script>
            alert('تم ارسال الحجز وسيتم التواصل معكم عبر الهاتف او الايميل')
            location.reload()
        </script>
    @endif


    @if ($message2 === true)
    <div class="alert alert-danger">عفوا لا توجد حجوزات لهذا اليوم الرجاء المحاولة لاحقا</div>
    @endif

    <form wire:submit.prevent="store">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                 <input type="text" name="username" wire:model="name" placeholder="اسمك" required>
                <span class="icon fas fa-user"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="tel" name="phone" wire:model="phone" placeholder="رقم الهاتف" required>
                <span class="icon fa fa-phone"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="email" name="email" wire:model="email" placeholder="البريد الالكتروني" required>
                <span class="icon fa fa-envelope"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">الطبيب</label>
                <select name="doctor" wire:model="doctor" class="form-select" id="exampleFormControlSelect1" required>
                    <option>-- اختر من القائمة --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">القسم</label>
                <select class="form-select" name="section" wire:model="section" id="exampleFormControlSelect2" required>
                    <option>-- اختر من القائمة --</option>
                    @foreach($sections as $section)
                        <option value="{{$section->id}}">{{$section->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">تاريخ الموعد</label>
                <input type="date" name="appointment_patient" wire:model="appointment_patient" placeholder="YYYY-MM-DD" required 
                class="form-control">
               
           </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <textarea name="notes" wire:model="notes" placeholder="ملاحظات"></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                    <span class="txt">تاكيد</span></button>
            </div>
        </div>
    </form>
</div>
