<?php

namespace App\Http\Administrator\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\CertificationFileType;

class CertificationFileTypeController extends Controller
{

	public function index()
	{
		$certificationFileTypes = CertificationFileType::all();

		return view('certificationfiletypes.index', ['certificationFileTypes' => $certificationFileTypes]);
	}

	public function edit(CertificationFileType $certificationFileType)
	{
		return view('certificationfiletypes.edit', ['certificationFileType' => $certificationFileType]);
	}

	public function store(Requests\SaveCertificationFileTypeRequest $request, CertificationFileType $certificationFileType)
	{
		$certificationFileType
			->fill($request->toArray())
			->save();

		return redirect(route('certificationfiletypes.index'));
	}

	public function create(CertificationFileType $certificationFileType)
	{
		return view('certificationfiletypes.create', ['certificationFileType' => $certificationFileType]);
	}

	public function update(Requests\SaveCertificationFileTypeRequest $request, CertificationFileType $certificationFileType)
	{
		$certificationFileType->update($request->toArray());

		return redirect(route('certificationfiletypes.index'));
	}
}
