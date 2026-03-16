import styles from './UserBadge.module.css';

interface UserBadgeProps {
  username: string;
  onClick?: () => void;
}

function UserBadge({ username, onClick }: UserBadgeProps) {
  return (
    <span className={styles.badge} onClick={onClick} role="button">
      {username}
    </span>
  );
}

export default UserBadge;
