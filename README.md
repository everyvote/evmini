# EveryVote Mini

All EveryVote.org code is provided under the GNU Affero General Public License version 3 http://www.gnu.org/licenses/agpl-3.0.html

This will be a small implementation of the EveryVote platform focusing on Student Government elections. Will be heavily integrated with Facebook.  There is nothing special working as of 8/29/12.

### Oct_2012 Branch Notes

I made some changes to the database structure (slight), and started building the controller and view related functionality. There is still a lot to be done.

In the ``app/Config/Schema/`` folder, there is a .sql file that you can use to import data and the schema structure. There is also an image of the ERD diagram.

This is nowhere near done, as there's a lot on the **TODO** list.


- Finish setting up the views for major components.
- Finish working on controller.
- Investigate CakePHP best practices and develop a coding standard and refactor when needed.
- Test Facebook login functionality. https://developers.facebook.com/docs/test_users/
- General CSS / HTML structure cleanup.

I will put some of these TODOs in the issue tracker.

--Shara   


--------------------------
### Vincent's Notes
--------------------------
As the new Fall semester is sucking my attention away, I've thrown up a copy of CakePHP to this repository and cobbled together a rough E-R diagram in MySQL workbench.

#### PHP/ CakePHP?
PHP, because most NIU CS students seem to know some PHP already because it is used in the databases course.  CakePHP because I'm personally fond of it. I think it has excellent documentation and a nice code generation tool.  However, the first commit is simply an install of CakePHP with no evmini specific code.  

#### What needs to be done?
Right now the [ER diagram](https://www.dropbox.com/s/hv7943ld5of30mo/evmini-er.pdf) probably needs to be polished some more.  The model files have to be made-- controllers need to be designed and built, FB library should be installed.  Getting a FB API key and all that mojo.

Contact me about anything-- including if you want access to the development server (http://mini.everyvote.org), access to the Dropbox share, and access to this repository.

Make sure to create github "Issues" that pertain to the work you're doing and self deligate.  So that we can all stay organized.

