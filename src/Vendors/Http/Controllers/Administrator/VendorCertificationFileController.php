<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;


use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\CertificationFile;
use App\Models\CertificationFileType;
use Myrtle\Core\Vendors\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class VendorCertificationFileController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');

		$this->certificationTypes = CertificationFileType::pluck('name', 'id');
	}

	public function download(Request $request, Vendor $vendor, CertificationFile $certificationFile)
	{
		$filename = $certificationFile->filePath . md5($certificationFile->id) . '.' . $certificationFile->file_extension;

		return Response::download($filename, $vendor->name . ' - ' . $certificationFile->type->name . '.xlsx');
	}

	public function create(Vendor $vendor, CertificationFile $certificationFile)
	{

		return view('vendors.certificationfiles.create', ['vendor' => $vendor, 'certificationFile' => $certificationFile, 'certificationTypes' => $this->certificationTypes]);
	}

	public function store(Requests\StoreVendorCertificationFileRequest $request, Vendor $vendor, CertificationFile $certificationFile)
	{
		$uploadedFile = $request->file('certification_file');
		$extension = $uploadedFile->getClientOriginalExtension();

		$certificationFile->fill(
			array_merge(['file_extension' => $extension], $request->toArray())
		);

		// Must save first to get the certification ID
		$certificationFile->save();

		// get file name
		$filename = md5($certificationFile->id) . '.' . $extension;

		// move uploaded file to storage path
		$uploadedFile->move($certificationFile->filePath, $filename);

		return redirect(route('vendors.show', $vendor->id));
	}

	public function edit(Vendor $vendor, CertificationFile $certificationFile)
	{
		return view('vendors.certificationfiles.edit', ['vendor' => $vendor, 'certificationFile' => $certificationFile, 'certificationTypes' => $this->certificationTypes]);
	}

	public function update(Requests\UpdateVendorCertificationFileRequest $request, Vendor $vendor, CertificationFile $certificationFile)
	{
		$uploadedFile = $request->file('certification_file');
		if ($uploadedFile)
		{
			$extension = $uploadedFile->getClientOriginalExtension();

			$certificationFile->fill(['file_extension' => $extension]);

			// get file name
			$filename = md5($certificationFile->id) . '.' . $extension;

			// move uploaded file to storage path
			$uploadedFile->move($certificationFile->filePath, $filename);
		}

		$certificationFile
			->fill($request->toArray())
			->save();

		return redirect(route('vendors.show', $vendor->id));
	}
}
