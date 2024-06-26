<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\StudentClass\StudentClass;

use App\Model\Siswa\Siswa;

use App\Model\AssessmentLog\AssessmentLog;

use Carbon\Carbon;

class DailyReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($this->getUserPermission('all report'))
        {
            $this->systemLog(false,'Mengakses Halaman Laporan');
            return view('daily-report.index', ['active'=>'daily-report']);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses Halaman Laporan');
            return view('error.unauthorized', ['active'=>'daily-report']);
        }
    }

    /**
     *
     */
    public function printPdf(Request $request)
    {
        $start_date = $request->session()->get('start_date');
        $end_date = $request->session()->get('end_date');
        $class_id = $request->session()->get('class_id');
        $data = $request->session()->get('data_assessment_log');

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('daily-report.all_student',[
            'start_date' => $start_date,
            'end_date' => $end_date,
            'class_id' => $class_id,
            'data' => $data 
        ]);

        if($this->getUserPermission('all report'))
        {
            $this->systemLog(false,'Mencetak Halaman Laporan Harian');
            return $pdf->stream();
        }
        else
        {
            $this->systemLog(true,'Gagal Mencetak Halaman Laporan Harian');
            return view('error.unauthorized', ['active'=>'daily-report']);
        }
    }


    /**
     *
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            
            // $date_from = Carbon::parse($request->get('start_date'))->startOfDay();
            // $date_to = Carbon::parse($request->input('end_date'))->endOfDay();

            // $data = AssessmentLog::whereDate('date', '>=', $date_from)
            // ->whereDate('date', '<=', $date_to)
            // ->leftJoin('tbl_siswa', 'tbl_siswa.id', '=', 'tbl_assessment_log.siswa_id')
            // ->where('memorization_type',$request->get('memorization_type'))
            // ->where('class_id',$request->get('student_class'))
            // ->orderBy('siswa_id', 'asc')
            // ->orderBy('date', 'desc')
            // ->get();

            $data = AssessmentLog::leftJoin('tbl_siswa', 'tbl_siswa.id', '=', 'tbl_assessment_log.siswa_id')
            ->where('memorization_type', $request->get('memorization_type'))
            ->where('class_id', $request->get('student_class'))
            ->orderBy('siswa_id', 'asc')
            ->orderBy('date', 'desc')
            ->get();

            
            // Store data in session
            $request->session()->put('start_date', $request->get('start_date'));
            $request->session()->put('end_date', $request->get('end_date'));
            $request->session()->put('class_id', StudentClass::findOrFail($request->get('student_class'))->class_name);
            $request->session()->put('data_assessment_log', $data);

            if($data->isEmpty())
            {
                $empty_data = 
                
                '<div class="alert alert-danger" role="alert">
                    <p> <strong> Maaf, Data yang anda cari tidak ditemukan pada tanggal tersebut </strong> </p>
                </div>';

                return $this->getResponse(false,200,$empty_data,'Berhasil menarik data');
            }
            
            $table  = '<table class="table table-striped">';
            $table .= '<thead>';
            $table .= '<tr>';
            $table .= '<th> ID </th>';
            $table .= '<th> Hafalan </th>';
            $table .= '<th> Tanggal </th>';
            $table .= '<th> Nilai</th>';
            $table .= '</tr>';
            $table .= '</thead>';
            $table .= '<tbody>';

            $old_assessment = null;

            foreach ($data as $assessment) 
            {
                $table .= '<tr>';

                if($assessment->siswa_id != $old_assessment)
                {
                    $table .= '<td>'.$assessment->getSiswa->nis.'<br>';
                    $table .= $assessment->getSiswa->siswa_name.'</td>';
                    $old_assessment = $assessment->siswa_id;
                }
                else
                {
                    $table .= '<td></td>';
                }
                
                $table .= '<td>'.$assessment->assessment. ' ' .$assessment->range.'</td>';
                $table .= '<td>'. date('d M Y h:i', strtotime($assessment->date)) .'</td>';
                $table .= '<td><a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-search"></i> Lihat</a></td>';
                $table .= '<div id="myModal" tabindex="-1" class="modal fade" role="dialog" aria-hidden="true">'; 
                $table .= '<div class="modal-dialog">';
                $table .= '<div class="modal-content">';
                $table .= '<div class="modal-header">';
                $table .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                $table .= '<h4 class="modal-title">Detail Assessment</h4>';
                $table .= '</div>';
                $table .= '<div class="modal-body">';
                
                if(isset($assessment->kelancaran)) {
                    $table .= 'Kelancaran: '.$assessment->kelancaran.'<br>';
                }
                
                if(isset($assessment->tajwid)) {
                    $table .= 'Tajwid: '.$assessment->tajwid.'<br>';
                }
                
                if(isset($assessment->makhraj)) {
                    $table .= 'Makhraj: '.$assessment->makhraj.'<br><br>';
                }
                
                if(isset($assessment->note)) {
                    $table .= 'Catatan: '.$assessment->note;
                }
                
                $table .= '</div>';
                $table .= '<div class="modal-footer">';
                $table .= '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                $table .= '</div>';
                $table .= '</div>';
                $table .= '</div>';
                $table .= '</div>';
                
                
                $table .= '</tr>';
            }
            
            $table .= '</tbody>';
            $table .= '</table>';

            if($this->getUserPermission('all report'))
            {
                return $this->getResponse(true,200,$table,'Berhasil menarik data');
            }
            else
            {
                return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            }
        }
    }
}
