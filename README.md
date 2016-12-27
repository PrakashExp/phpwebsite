# Đây là password của tui để login admin
User: TrieuTrangVinh
Pass: TrieuTrangVinhA01

# Customer
User: AnCongDao
Pass: 55453

# Agent
User: AnhDinhHieu
Pass: 71870

#Thông báo, thông báo, thông báo !!!
Các đồng chí thân mến!

Thay mặt Quốc trưởng tối cao, tôi xin hướng dẫn các đồng chí cách cài đặt PEAR Mail 

Lưu ý: Nếu không cài thì phần Mail sẽ không hoạt động !
```
Để XAMPP chạy được gói PEAR Mail (dùng để gửi mail), các đồng chí thực hiện như sau:
1. Vào cmd, chạy với quyền Admin (hoặc là Terminal trên Linux)
2. Chuyển tới thư mục xampp trong cmd (hoặc Terminal)
3. Gõ lệnh sau:
```
```
#!shell script
---Với Windows
pear install --alldeps Mail
```

```
#!shell script
---Với Linux
wget http://pear.php.net/go-pear.phar
php go-pear.phar
```

Các đồng chí vui lòng truy cập trang http://pear.php.net/ để biết thêm chi tiết


#Beep beep beep !!!
```
#!shell script
Frontend rùa bò quá...
```

# Mấy chế, mấy chế
```
#!shell script
Tên đăng nhập: Tên user viết liền, ko dấu, các chữ cái đầu tiên viết hoa.
Mật khẩu:
-Khách hàng, nhân viên: dãy số trước '@' trong email.
-Admin: Tên đăng nhập + 'A' + 2 số cuối của ID. VD: LeThiChauNganA03, LuuThanhSonA02, TrieuTrangVinhA01....

Cái phần nạp thư viện, mấy chế dùng rì quai đờ gạch quanh sờ nha... Đừng dùng in cờ lú đờ...
Dùng pi đi au chứ đừng dùng ét sờ kiêu eo nha...
Phần đặt tên hàm, tên biến theo kiểu lạc đà ak, đừng dùng mấy ký tự - _, nó lộn xộn lắm. VD: button giỏ hàng: btnCart, hiển thị form đăng ký: displayFormRegister,...
```

# How to run this project
```
#!shell script

You can download XAMPP from: https://www.apachefriends.org/index.html
After that, open XAMPP, and start Apache, and MySQL
Now, open your browser and enter localhost/phpmyadmin, you can create database from there.
Move this project to "xampp/htdocs/"  now you can access your project by enter url localhost/your_name_project_folder
```
# How to use git (tool helps you to synchronize the project)
```
#!shell script

Download and install git, from: https://git-scm.com/
When installing complete, open your command line prompt or terminal
and then type: git --version    // make sure you've install git

// If don't have this project folder before, create a empty project folder, and cd to your project folder
Type these line:
git init     // init git files
git remote add origin https://your_user_name@bitbucket.org/mrwen00/phpwebsite.git
git pull

// Pull code form server (get latest code from server).
Open your commandline prompt, and cd to your project folder.
Then type these:
git pull     // get new code
Enter password // it will not show

// Push your code to server (upload your code to server).
git status     // listing all of modified files or created files
git add --all  // add all files to list and prepare to commit code
git commit -m "Type your description here about your code"
git push origin master       // push your code to server, you need to enter your password

// Remember user and password in git
git config credential.helper store
Sample: 
git config credential.helper store
git push http://example.com/repo.git
Username: <type your username>
Password: <type your password>
[several days later]
git push http://example.com/repo.git
[your credentials are used automatically]

```
