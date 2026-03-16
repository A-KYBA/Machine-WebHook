import DashboardTitle from '../../atoms/DashboardTitle/DashboardTitle';
import UserBadge from '../../atoms/UserBadge/UserBadge';
import styles from './Header.module.css';

function Header() {
  return (
    <header className={styles.header}>
      <DashboardTitle />
      <UserBadge username="username" />
    </header>
  );
}

export default Header;
