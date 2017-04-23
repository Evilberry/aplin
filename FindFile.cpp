void findAllFiles( std::string _patch )
{
  WIN32_FIND_DATA FindData;
  std::string modifiler_address =  _patch; modifiler_address += "*";
  HANDLE Handle = FindFirstFile( modifiler_address.c_str() , &FindData);//ищем первый файл
  while( FindNextFile(Handle, &FindData) )//и только теперь проходим по нужным нам файлам
  {
    std::string file_name = FindData.cFileName;
    //Чтобы не возникало  рекурсии
    if( FindData.dwFileAttributes & FILE_ATTRIBUTE_DIRECTORY )
    {
      if( ! !strcmp(FindData.cFileName, "..") )
      {
        //Новый аддресс
        std::string new_patch = _patch ;
        new_patch += file_name;
        new_patch += "/"; 

        findAllFiles( list_files, new_patch );
      }
    }
    else
    {
      std::string final_address = _patch; final_address += file_name;
      //list_files.push_back( zFileInfo( final_address )  );  
                          std::cout << final_address.c_str() << "\n";
    } 
    
  }
}
