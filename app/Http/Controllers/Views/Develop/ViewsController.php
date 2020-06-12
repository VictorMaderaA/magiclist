<?php


namespace App\Http\Controllers\Views\Develop;


use App\Http\Controllers\Base\BaseController;
use Illuminate\Support\Facades\File;

class ViewsController extends BaseController
{

    public function index()
    {
        $filesRaw = File::allFiles(base_path('resources/views'));
        $files = [];
        foreach ($filesRaw as $file){
            $newFile = [];
            $newFile['fileName'] = $file->getFilename();
            $newFile['pathName'] = $file->getRelativePathname();
            $newFile['path'] = $file->getRelativePath();
            $pathKey = str_replace("/", ".", $file->getRelativePath());
            $newFile['id'] = (empty($pathKey)? '' : $pathKey . '.').explode('.', $file->getFilename())[0];
            array_push($files, $newFile);
        }

        return view('develop.views_index')
            ->with('files', $files);
    }

    public function show($id)
    {
        $view = view($id);

        $dataPath = base_path('resources/views_data/'.$id.'.php');
        if(File::exists($dataPath)){
            $data = File::getRequire($dataPath);
            foreach ($data as $key => $value){
                $view->with($key, $value);
            }
        }

        return $view;
    }

}
