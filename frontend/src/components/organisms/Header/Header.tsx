import DashboardTitle from '../../atoms/DashboardTitle/DashboardTitle';
import UserBadge from '../../atoms/UserBadge/UserBadge';
import styles from './Header.module.css';

interface HeaderProps {
  username: string;
  onUserClick: () => void;
}

function Header({ username, onUserClick }: HeaderProps) {
  return (
    <header className={styles.header}>
      <DashboardTitle />
      <UserBadge username={username} onClick={onUserClick} />
    </header>
  );
}

export default Header;
