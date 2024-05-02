@extends('layout/admin-layout')

@section('space-work')

<div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><strong style="color:rgb(41, 141, 158); font-family: 'Poppins', sans-serif; font-size: 40px;"><u></u> Exams </strong></h1>
      </div>
    </div>

<div>
      <!-- Button trigger modal -->
    <button style="font-family: Bahnschrift; " type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#addExamModal">
    <span class="fa fa-plus-circle"> </span>Add New Exam
    </button>
    <br><br>
</div>

<table class="table">
    <thead class="table-rawng">
        <tr>
            <th>Exam id</th>
            <th>Exam name</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Time</th>
            <th>Add Question</th>
            <th>Show Question</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        @if(count($exams) > 0) <!-- //checking of the data came to here form the database -->
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $exam->id }}</td>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->subjects[0]['subject']}}</td>  <!--   here we get from the subjects table where we use the many to one relationship -->
                    <td>{{ $exam->date }}</td>
                    <td>{{ $exam->time }} Hrs</td>
                    <td>
                        <a href="#" class="addQuestions" style="color:#206649;" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#addQnaModal"><span class="fa fa-plus-circle"></span>Add Question</a>
                    </td>
                    <td>
                        <a href="#" class="seeQuestions" style="color:#206649;" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#seeQnaModal"><span class="fa fa-plus-circle"></span>See Question</a>
                    </td>
                    <td>
                        <button class="btn btn-outline-info editButton btn-sm" data-id="{{$exam->id}}" data-toggle="modal" data-target="#editExamModal"><span class="fa fa-pencil-square-o"></span></button>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger deleteButton btn-sm" data-id="{{$exam->id}}" data-toggle="modal" data-target="#deleteExamModal"><span class="fa fa-trash"></span></button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspam="5">Exams not found</td>
            </tr>
        @endif
    </tbody>

</table>



<!-- Modal for adding the exam -->
<div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>

          <form id="addExam">
      <!-- Tpken for sending the value/data -->
      <!-- sisplaying all the data -->
      @csrf
            <div class="modal-body">
                <input type="text" name="exam_name" placeholder="Enter Exam Name" class="w-100" required>
                <br><br>
                <select name="subject_id" required class="w-100">
                    <option value="">Select Subject</option>
                    @if(count($subjects) > 0)     <!--//checking if the subject exists in the database -->
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject -> subject}}</option> <!--//keeping the data in the option -->
                        @endforeach
                    @endif    
                </select>
                <br><br>
                <input type="date" name="date" class="w-100" required min="@php echo date('Y-m-d') @endphp"> <!-- using min="" we restrict that the admin cannot use the date that is the previous date -->
                <br><br>
                <input type="time" name="time" class="w-100" value='03:00' min='01:00' max= '03:00' required>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-info">Add Exam</button>
            </div>
            </div>
    </form>
  </div>
</div>  



<!-- Modal for editing the exam -->
<div class="modal fade" id="editExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>

          <form id="editExam">
      <!-- Tpken for sending the value/data -->
      <!-- displaying all the data -->
      @csrf
            <div class="modal-body">
                <input type="hidden" name="exam_id"  id="exam_id">
                <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam Name" class="w-100" required>
                <br><br>
                <select name="subject_id" id="subject_id" required class="w-100">
                    <option value="">Select Subject</option>
                    @if(count($subjects) > 0)     <!--//checking if the subject exists in the database -->
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject -> subject}}</option> <!--//keeping the data in the option -->
                        @endforeach
                    @endif    
                </select>
                <br><br>
                <input type="date" name="date" id="date" class="w-100" required min="@php echo date('Y-m-d') @endphp"> <!-- using min="" we restrict that the admin cannot use the date that is the previous date -->
                <br><br>
                <input type="time" name="time" value='03:00' min='01:00' max= '03:00' class="w-100" required>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-info">Update</button>
            </div>
            </div>
    </form>
  </div>
</div>  



<!-- Modal for Deleting the exam -->
<div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>

          <form id="deleteExam"> 

      @csrf
            <div class="modal-body">
                <input type="hidden" name="exam_id"  id="deleteExamId">
                <p>are you sure you wan't to delete the EXAM ?</p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </div>
            </div>
    </form>
  </div>
</div> 

<!-- Modal for adding the Answers -->
<div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>

          <form id="addQna">

      @csrf
            <div class="modal-body">
                <input type="hidden" name="exam_id" id="addExamId">
                <input type="search" name="search" class="w-100" placeholder="search">
                <br><br>
                <table class="table table-bordered">
                    <thead class="table-rawng">
                        <th>Select</th>
                        <th>Question</th>
                    </thead>
                    <tbody class="addBody">

                    </tbody>
                </table>

            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Add Q&A</button>
            </div>
            </div>
    </form>
  </div>
</div> 



<div class="modal fade" id="seeQnaModal" tabindex="-1" role="dialog" aria   -labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Q&A</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
  
              <div class="modal-body">
                  <table class="table table-bordered">
                      <thead class="table-rawng">
                          <th> Question</th>
                      </thead>
                      <tbody class="seeQuestionTable">
  
                      </tbody>
                  </table>
  
              </div>
              
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
              </div>
              </div>
      </form>
    </div>
  </div> 




<script>
    
    $(document).ready(function(){


        $('#addExam').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize(); //we get the data 

            $.ajax({
                url:"{{ route('addExam')}}", //passing the route
                type: "POST",
                data:formData,
                success:function(data){ //checking the data
                    if(data.success == true){
                        location.reload();//reload the page
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });



        //edit exam button modal link
        $(".editButton").click(function(){
            var id = $(this).attr('data-id');
            $("#exam_id").val(id);

            var url = '{{route("getExamDetail","id")}}';
            url = url.replace('id',id);

            $.ajax({
                url:url,
                type:"GET",
                success:function(data){
                    // to check the data using this statement the data show in the console// console.log(data);
                    if(data.success == true)
                    {
                        var exam = data.data; //to input the data in the modal
                        $("#exam_name").val(exam[0].exam_name);
                        $("#subject_id").val(exam[0].subject_id);
                        $("#date").val(exam[0].date);
                        $("#time").val(exam[0].time);
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });    //when we click 


        $('#editExam').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize(); //we get the data 

            $.ajax({
                url:"{{ route('updateExam')}}", //passing the route
                type: "POST",
                data:formData,
                success:function(data){ //checking the data
                    if(data.success == true){
                        location.reload();//reload the page
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });


        //delete exam 
        $(".deleteButton").click(function(){
            var id = $(this).attr('data-id');  //getting data
            $("#deleteExamId").val(id);  //the id for the button in the row delete exam  

        });

        $("#deleteExam").submit(function(e){ //when the delete exam form in submitted
            e.preventDefault();

            var formData = $(this).serialize(); //we get the data 

            $.ajax({
                url:"{{ route('deleteExam')}}", //passing the route of the route in the web 
                type: "POST",
                data:formData,
                success:function(data){ //checking the data
                    if(data.success == true){
                        location.reload();//reload the page
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });


        //add question part
        $('.addQuestions').click(function(){

           var id =  $(this).attr('data-id');
           $('#addExamId').val(id);

           $.ajax({
                url:"{{ route('getQuestions')}}",
                type:"GET",
                data:{exam_id:id},
                success:function(data){
                    //console.log(data)// to see the data
                    //
                    if(data.success == true){

                        var questions = data.data; //all the question assign to questions
                        var html = '';

                        //check if there are question which is not added on the exam table of this id
                        if(questions.length > 0){
                            for(let i = 0; i < questions.length;i++){
                                //checkbox 
                                html += `
                                    <tr>
                                        <td><input type="checkbox" value="`+questions[i]['id']+`" name="question_ids[]"></td>
                                        <td>`+questions[i]['questions']+`</td>
                                    </tr>
                                `;
                            }
                        }
                        else{
                            html +=`
                            <tr>
                                <td colspan="2">Questions not available!</td>
                            </tr>
                            `;
                        }
                        $('.addBody').html(html); //apending the html
                    }
                    else{
                        alert(data.msg);
                    }
                }
           });
            

        })

        //submitting the q&a checkbox
        $("#addQna").submit(function(e){ //when the delete exam form in submitted
            e.preventDefault();

            var formData = $(this).serialize(); //we get the data 

            $.ajax({
                url:"{{ route('addQuestions')}}", //passing the route of the route in the web 
                type: "POST",
                data:formData,
                success:function(data){ //checking the data
                    if(data.success == true){
                        location.reload();//reload the page
                    }
                    else{
                        alert(data.msg);
                    }
                }
            });
        });

        $('.seeQuestions').click(function(){
    var id = $(this).attr('data-id');

    $.ajax({
    url: "{{ route('getExamQuestions') }}",
    type: "GET",
    data: { exam_id: id },
    success: function (data) {
        var html = '';
        var questions = data.data;
        if (questions.length > 0) {
            for (let i = 0; i < questions.length; i++) {
                html += `
                    <tr>
                        <td>` + (i + 1) + `</td>
                        <td>` + questions[i]['question'][0]['question'] + `</td>
                    </tr>
                `;
            }
        } else {
            html += `
                <tr>
                    <td colspan="2">No Questions assigned</td>
                </tr>
            `;
        }
        $('.seeQuestionTable').html(html);
    }
});
});
    });

</script>



@endsection
