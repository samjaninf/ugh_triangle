@extends('app.layouts.main')

@section('title')
    {!! tr("publish_times") !!}
@stop

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <ul class="nav nav-tabs tabs tabs-top" style="width: 100%;">
            <?php $i = 0;?>
            @foreach($profiles as $profile)
                <?php $i++;?>
                <li class="tab {!! $i==1?"active":"" !!}" style="width: 25%;">
                    <a href="#profile{!! $profile->id !!}" data-toggle="tab" aria-expanded="false" class="active">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">{!! $profile->name !!}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            <?php $i = 0;?>
            @foreach($profiles as $profile)
                <?php $i++;?>
                <div class="tab-pane {!! $i==1?"active":"" !!}" id="profile{!! $profile->id !!}">
                    <h3 class="panel-title">{!! tr("add") !!}</h3>
                    {!! Form::open(['url' => 'app/ptime/'.$profile->id]) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <select name="day" class="form-control">
                                <option value="1">{!! tr("days.monday") !!}</option>
                                <option value="2">{!! tr("days.tuesday") !!}</option>
                                <option value="3">{!! tr("days.wednesday") !!}</option>
                                <option value="4">{!! tr("days.thursday") !!}</option>
                                <option value="5">{!! tr("days.friday") !!}</option>
                                <option value="6">{!! tr("days.saturday") !!}</option>
                                <option value="7">{!! tr("days.sunday") !!}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="hour" class="form-control text-center">
                                <option value="1">1</option>
                                <option value="3">2</option>
                                <option value="3">4</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="minute" class="form-control">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="3">2</option>
                                <option value="3">4</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center" style="margin-bottom: 20px;">
                                <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> {!! tr("add") !!}
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>

                    {!! Form::close() !!}
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="col-md-7">{!! tr("day") !!}</th>
                            <th class="col-md-3">{!! tr("hour") !!} / {!! tr("minute") !!}</th>
                            <th>{!! tr("options") !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($profile->ptimes as $time)
                            <tr>
                                <td>{!! \App\Classes\DateHelper::convert($time->day) !!}</td>
                                <td class="text-center">{!! sprintf("%02d",$time->hour) !!}
                                    :{!!sprintf("%02d",$time->minute) !!}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{!! url('app/ptime/'.$time->id.'/delete') !!}" class="btn btn-primary"><i
                                                    class="fa fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{!! tr("you_have_no_ptimes") !!}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@stop
