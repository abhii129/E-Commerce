<?php

namespace App\Http\Controllers;

use App\Models\FooterSection; 
use Illuminate\Http\Request;

class FooterSectionController extends Controller
{
        // app/Http/Controllers/FooterSectionController.php

    public function edit($section_key)
    {
        $section = FooterSection::firstOrCreate(['section_key' => $section_key]);
        return view('admin.footer.edit', [
            'section_key' => $section_key,
            'data' => $section->data ?? [],
        ]);
    }

    public function update(Request $request, $section_key)
    {
        // Add validation logic tailored to the section_key
        $data = $request->input('data');

        FooterSection::updateOrCreate(
            ['section_key' => $section_key],
            ['data' => $data]
        );

        return redirect()->back()->with('success', 'Section updated!');
    }

}
